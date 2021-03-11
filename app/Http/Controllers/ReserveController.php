<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

use App\Mail\ReservationBooking;
use App\Models\Camper;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stripe\StripeClient;

class ReserveController extends Controller
{
    public function show()
    {
        return view('public.reserve');
    }

    public static function getReservations($camping_type, $date)
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

                'date_in' => 'required|date|after:' . date_format($arrival, 'Y-m-d'),
                'date_out' => 'required|date|after:date_in',

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
        $res->date_in = strtotime($r->input('date_in'));
        $res->date_out = strtotime($r->input('date_out'));

        // convert from seconds -> minutes -> hours -> days
        $nights = ($res->date_out - $res->date_in) / 60 / 60 / 24;

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

        // $39 for tents, $69 for RV
        $cost = 0;
        switch ($res->camping_type) {
            case 0: // single tent
            case 1: // second tent
                $cost = 39;
                break;
            case 2: // rv spot
                $cost = 69;
                break;
        }
        $cost *= $nights;
        // flat fee for the second tent
        if ($res->camping_type == 1) $cost += 30;

        Session::flash('data', [
            'reservation' => $res,
            'campers' => $campers,
            'cost' => $cost,
        ]);
        return redirect('/reserve/checkout');
    }

    public function checkout()
    {
        $data = Session::get('data');
        if (!isset($data)) return redirect('reserve');

        $res = $data['reservation'];

        $db = DB::table('reservations');
        switch ($res->camping_type) {
            case 0: // single tent
            case 1: // double tent
                $db = $db
                    ->where('camping_type', 0)
                    ->orWhere('camping_type', 1);
                break;
            case 2: // RV spot
                $db = $db->where('camping_type', 2);
                break;
        }

        // amt of ppl still camping when the reservation starts
        $db = $db->where('date_out', '>=', $data['date_in'])->get();
        $count = sizeof($db);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $checkout_session = $stripe->checkout->sessions->create([
            'customer_email' => $res->email,
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
            'success_url' => url('/reserve/success') . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => url('/reserve'),
        ]);
        $data['id'] = $checkout_session->id;

        Session::flash('data', $data);
        return view('public.reserve.checkout', $data);
    }

    public function success()
    {
        $data = Session::get('data');
        if (!isset($data)) return redirect('reserve');

        $res = $data['reservation'];
        $campers = $data['campers'];

        $res->save();
        foreach ($campers as $camper) {
            $camper->reservation_id = $res->id;
            $camper->save();
        }

        Mail::to(env('MAIL_TO_ADDRESS'))->queue(new ReservationBooking($res)); // send e-mail
        // Mail::to($data['customer']['email'])->queue(new ReservationBooking($data)); // send e-mail

        return view('public.reserve.success', $data);
    }
}
