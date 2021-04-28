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
use Illuminate\Support\Facades\Validator;
use Exception;

class ReserveController extends Controller
{
    public function show()
    {
        return view('public.reserve');
    }

    public static function getReservationsOn($date, $camping_type)
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
        $campingTypes = ReservationUtil::getCampingTypes();
        $validator = Validator::make(
            $r->all(),
            [ // rules

                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/^\(?\d{3,}\)?[ -]?\d{3,}[ -]?\d{4,}$/',
                'age' => 'required|numeric|min:18',

                'campers_count' => 'required|numeric|min:1|max:6',
                // camping_type starts at 1 due to the blade loop directive iterations starting at 1
                'camping_type' => 'required|numeric|min:0|max:' . sizeof($campingTypes),
            ]
        );
        if ($validator->fails()) {
            return redirect('reserve')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = [
            'customer' => [
                'first' => $r->input('first_name'),
                'last' => $r->input('last_name'),
                'email' => $r->input('email'),
                'phone' => $r->input('phone'),
                'age' => $r->input('age'),
            ],

            'campers_count' => intval($r->input('campers_count')),
            'campers' => array(),

            'dates' => $r->input('dates'),
            // subtract 1 due to the blade loop directive iterations starting at 1
            'camping_type' => intval($r->input('camping_type')),
        ];

        $dates = explode(' - ', $inputs['dates']);
        $arrival = strtotime($dates[0]);
        $departure = strtotime($dates[1]);
        if (!$arrival || !$departure || $arrival > $departure) {
            return redirect('/reserve')
                ->withErrors(['error' => 'Invalid reservation date provided'])
                ->withInput();
        }
        // convert from (seconds -> minutes -> hours -> days)
        $nights = (($departure - $arrival) / 60 / 60 / 24);
        if ($nights < 1) {
            return redirect('/reserve')
                ->withErrors(['error' => 'Reservation must be at least 1 night'])
                ->withInput();
        }

        $count = $this->getReservationsOn($arrival, $inputs['camping_type']);
        if ($count >= ReservationUtil::getMaxReservations()) {
            return redirect('/reserve')
                ->withErrors(['error' => 'Sorry! All campgrounds are currently reserved for those days'])
                ->withInput();
        }

        // initialize reservation ORM object
        $reservation = new Reservation();
        $reservation->first_name = $inputs['customer']['first'];
        $reservation->last_name = $inputs['customer']['last'];
        $reservation->email = $inputs['customer']['email'];
        $reservation->phone = $inputs['customer']['phone'];
        $reservation->age = $inputs['customer']['age'];

        $reservation->camping_type = $inputs['camping_type'];

        $reservation->date_in = $arrival;
        $reservation->date_out = $departure;

        $camper = new Camper();
        $camper->first_name = $inputs['customer']['first'];
        $camper->last_name = $inputs['customer']['last'];
        array_push($inputs['campers'], $camper);

        // '-1' because member above is created manually
        $count = $r->input('campers') - 1;
        for ($i = 0; $i < $count; $i++) {
            $camper = new Camper();
            $camper->first_name = $r->input('camper' . $i . '_first_name');
            $camper->last_name = $r->input('camper' . $i . '_last_name');
            array_push($inputs['campers'], $camper);
        }

        Session::flash('reservation', [
            'reservation' => $reservation,
            'campers' => $inputs['campers'],
        ]);

        return redirect('/reserve/checkout');
    }

    public function checkout()
    {
        $data = Session::get('reservation');
        if (!isset($data)) return abort(404);

        $reservation = $data['reservation'];
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $checkout_session = $stripe->checkout->sessions->create([
            'customer_email' => $reservation->email,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'cad',
                    'unit_amount' => $reservation->getCost() * 100,
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

        // the 'id' is needed for stripe checkout redirect
        $data['checkout_session'] = $checkout_session;
        Session::flash('reservation', $data);
        Session::put('email_ts', 0); // reset email timestamp
        return view('public.reserve.checkout', $data);
    }

    public function success()
    {
        $data = Session::get('reservation');
        if (!isset($data)) return abort(404);

        $checkout_session = $data['checkout_session'];
        $res = $data['reservation'];
        $campers = $data['campers'];

        $res->payment_intent = $checkout_session->payment_intent;
        $res->save();
        foreach ($campers as $camper) {
            $camper->reservation_id = $res->id;
            $camper->save();
        }

        $email_ts = Session::get('email_ts');
        $send_email = true;
        if ($email_ts) {
            $email_wait = $email_ts->diffInMinutes(now());
            if ($email_wait < 3) {
                $send_email = false;
            }
        }
        if ($send_email) {
            Session::put('email_ts', now());
            Mail::to($res->email) // send to customer
                ->bcc(env('MAIL_TO_ADDRESS')) // send to admin
                ->queue(new ReservationBooking($res));
        }

        return view('public.reserve.success', [
            'reservation' => $res
        ]);
        // return view('email.reservation', ['reservation' => $res]);
    }
}
