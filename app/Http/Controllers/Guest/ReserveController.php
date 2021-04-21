<?php

namespace App\Http\Controllers\Guest;

use App\Helper\ReservationUtil;
use App\Models\Reservation;
use App\Mail\ReservationBooking;
use App\Http\Controllers\Controller;
use App\Models\Camper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Exception;

class ReserveController extends Controller
{
    public function show()
    {
        $geomap = '';
        if (Storage::disk('local')->exists('geomap.json')) {
            $geomap = Storage::disk('local')->get('geomap.json');
        }
        return view('public.reserve', ['geomap' => $geomap]);
    }

    public static function get_reservations_on($date, $camping_type)
    {
        $result = DB::table('reservations');
        switch ($camping_type) {
            case 0: // single tent
            case 1: // double tent
                $result = $result
                    ->where('camping_type', 0)
                    ->orWhere('camping_type', 1);
                break;
            case 2: // RV spot
                $result = $result->where('camping_type', 2);
                break;
            default:
                throw new Exception("invalid camping_type: " . $camping_type);
        }

        // amt of ppl still camping when the reservation starts
        $result = $result->where('date_out', '>=', $date)->get();
        return sizeof($result);
    }

    public function submit(Request $r)
    {
        // arrival date must be today but Validator
        // uses the 'after' filter thus arrival date
        // needs to be after yesterday to be today, if that makes sense
        $arrival = new DateTime();
        $arrival->modify('-1 day');

        $validator = Validator::make(
            $r->all(),
            [ // rules
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/^\(?\d{3,}\)?[ -]?\d{3,}[ -]?\d{4,}$/',
                'age' => 'required|numeric|min:18',
                'camping_type' => 'required|numeric|min:0|max:2',
                'campers' => 'required|numeric|min:1|max:6',
            ],
            [],
            [
                'date_in' => 'arrival',
                'date_out' => 'departure',
            ]
        );
        if ($validator->fails()) {
            return redirect('reserve')
                ->withErrors($validator)
                ->withInput();
        }

        $res = new Reservation();
        $res->first_name = $r->input('first_name');
        $res->last_name = $r->input('last_name');
        $res->email = $r->input('email');
        $res->phone = $r->input('phone');
        $res->age = $r->input('age');
        $res->camping_type = $r->input('camping_type');

        $dates = $r->input('dates');
        $dates = explode(' - ', $dates);
        $res->date_in = $arrival = strtotime($dates[0]);
        $res->date_out = $depature = strtotime($dates[1]);

        if ($res->date_in >= $res->date_out) {
            return redirect('/reserve')
                ->withErrors(['error' => 'Invalid reservation date provided'])
                ->withInput();
        }

        $count = $this->get_reservations_on($res->date_in, $res->camping_type);
        if ($count >= ReservationUtil::getMaxReservations()) {
            return redirect('/reserve')
                ->withErrors(['error' => 'Sorry! All campgrounds are currently reserved.'])
                ->withInput();
        }

        // convert from (seconds -> minutes -> hours -> days) + 1
        // +1 is date inclusive such that 21st -> 22nd is 2 nights
        $nights = (($depature - $arrival) / 60 / 60 / 24) + 1;

        $campers = array();
        $mem = new Camper();
        $mem->first_name = $r->input('first_name');
        $mem->last_name = $r->input('last_name');

        array_push($campers, $mem);

        // '-1' because member above is created manually
        $count = $r->input('campers') - 1;
        for ($i = 0; $i < $count; $i++) {
            $mem = new Camper();
            $mem->first_name = $r->input('camper' . $i . '_first_name');
            $mem->last_name = $r->input('camper' . $i . '_last_name');
            array_push($campers, $mem);
        }

        $cost = 0;
        // Medium Tent: $39
        if ($res->camping_type == 0) $cost = 39 * $nights;
        // Extra Medium Tent: $39 + 30 one-time fee
        else if ($res->camping_type == 1) $cost = (39 * $nights) + 30;
        // Recreational Vehicle: $69
        else if ($res->camping_type == 2) $cost = 69 * $nights;

        Session::flash('data', [
            'reservation' => $res,
            'campers' => $campers,
            'cost' => $cost,
            'nights' => $nights
        ]);

        return redirect('/reserve/checkout');
    }

    public function checkout()
    {
        $data = Session::get('data');
        if (!isset($data)) return abort(404);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $checkout_session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'cad',
                    'unit_amount' => $data['cost'] * 100,
                    'product_data' => [
                        'name' => 'Stoney Park Campgrounds Reservation'
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/reserve/success'),
            'cancel_url' => url('/reserve'),
        ]);
        $data['id'] = $checkout_session->id;

        Session::flash('data', $data);
        return view('public.reserve.checkout', $data);
    }

    public function success()
    {
        $data = Session::get('data');
        if (!isset($data)) return abort(404);
        Session::flash('data', $data);

        $res = $data['reservation'];
        $campers = $data['campers'];

        $res->save();
        foreach ($campers as $camper) {
            $camper->reservation_id = $res->id;
            $camper->save();
        }

        Mail::to(env('MAIL_TO_ADDRESS'))->queue(new ReservationBooking($res, $campers)); // send e-mail to admin
        Mail::to($res->email)->queue(new ReservationBooking($res, $campers)); // send e-mail to customer

        return view('public.reserve.success', [
            'reservation' => $res,
            'campers' => $campers,
            'nights' => $data['nights'],
        ]);
    }
}
