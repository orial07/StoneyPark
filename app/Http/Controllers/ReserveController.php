<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

use App\Mail\ReservationBooking;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
    public function show()
    {
        return view('public.reserve');
    }

    public function submit(Request $r)
    {
        $validator = Validator::make(
            $r->all(),
            [ // rules
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                // https://stackoverflow.com/questions/16699007/regular-expression-to-match-standard-10-digit-phone-number
                'phone' => 'required|regex:/^\(?\d{3,}\)?[ -]?\d{3,}[ -]?\d{4,}$/',
                'age' => 'required|numeric|min:18',

                'date_in' => 'required|date',
                'date_out' => 'required|date|after:date_in',

                'campingType' => 'required|numeric|min:0|max:2',
                'campers' => 'required|numeric|min:0|max:6',
            ],
            [ // messages
            ],
            [ // attributes
            ]
        );
        if ($validator->fails()) {
            return redirect('reserve')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'customer' => [
                'first_name' => $r->input('first_name'),
                'last_name' => $r->input('last_name'),
                'email' => $r->input('email'),
                'phone' => $r->input('phone'),
                'age' => $r->input('age'),
            ],
            'date_in' => strtotime($r->input('date_in')),
            'date_out' => strtotime($r->input('date_out')),
            'members' => array(),
        ];


        $campingType = $data['camping_type'] = $r->input('campingType');
        // convert from seconds -> minutes -> hours -> days
        $nights = $data['nights'] = ($data['date_out'] - $data['date_in']) / 60 / 60 / 24;

        array_push($data['members'], [
            'first_name' => $data['customer']['first_name'],
            'last_name' => $data['customer']['last_name'],
        ]);
        $campersCount = $r->input('campers') - 1;
        for ($i = 0; $i < $campersCount; $i++) {
            array_push($data['members'], [
                'first_name' => $r->input('camper' . $i . '_first_name'),
                'last_name' => $r->input('camper' . $i . '_last_name'),
            ]);
        }

        // $39 for tents, $69 for RV
        $cost = 0;
        switch ($campingType) {
            case 0: // single tent
            case 1: // second tent
                $cost = 39;
                break;
            case 2: // rv spot
                $cost = 69;
                break;
        }
        $cost *= $nights;
        if ($campingType == 1) $cost += 30; // flat fee for the second tent
        $data['cost'] = $cost;

        Session::flash('data', $data);
        return redirect('/reserve/checkout');
    }

    public function checkout()
    {
        $data = Session::get('data');
        if (!isset($data)) {
            return redirect('reserve');
        }

        $result = DB::table('reservations');
        switch ($data['camping_type']) {
            case 0: // single tent
            case 1: // double tent
                $result = $result
                    ->where('camping_type', 0)
                    ->orWhere('camping_type', 1);
                break;
            case 2: // RV spot
                $result = $result->where('camping_type', 2);
                break;
        }

        // amt of ppl still camping when the reservation starts
        $result = $result->where('date_out', '>=', $data['date_in'])->get();
        $count = sizeof($result);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $checkout_session = \Stripe\Checkout\Session::create([
            'customer_email' => $data['customer']['email'],
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
            'cancel_url' => url('/reserve/cancel') . "?session_id={CHECKOUT_SESSION_ID}",
        ]);
        $data['id'] = $checkout_session->id;

        Session::flash('data', $data);
        return view('public.reserve.checkout', $data);
    }

    public function success()
    {
        Session::reflash();
        $data = Session::get('data');
        if (!isset($data)) {
            return redirect('reserve');
        }

        $reservation = new Reservation();
        $reservation->first_name = $data['customer']['first_name'];
        $reservation->last_name = $data['customer']['last_name'];
        $reservation->email = $data['customer']['email'];
        $reservation->phone = $data['customer']['phone'];
        $reservation->age = $data['customer']['age'];
        $reservation->camping_type = $data['camping_type'];
        $reservation->date_in = $data['date_in'];
        $reservation->date_out = $data['date_out'];
        $reservation->save();

        Mail::to(env('MAIL_TO_ADDRESS'))->queue(new ReservationBooking($data)); // send e-mail
        // Mail::to($data['customer']['email'])->queue(new ReservationBooking($data)); // send e-mail

        // return view('email.reservation', $data);
        return view('public.reserve.success', $data);
    }
}
