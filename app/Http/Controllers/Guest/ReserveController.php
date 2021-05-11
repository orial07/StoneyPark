<?php

namespace App\Http\Controllers\Guest;

use App\Helper\ReservationUtil;
use App\Models\Reservation;
use App\Mail\ReservationBooking;
use App\Http\Controllers\Controller;
use App\Models\Camper;
use App\Models\Campground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
    public function show()
    {
        return view('public.reserve');
    }

    public function submit(Request $r)
    {
        $campingTypes = ReservationUtil::getCampingTypes();
        $validator = Validator::make(
            $r->all(),
            [ // rules

                'user-name-first' => 'required',
                'user-name-last' => 'required',
                'user-email' => 'required|email',
                'user-phone' => 'required|regex:/^\(?\d{3,}\)?[ -]?\d{3,}[ -]?\d{4,}$/',
                'user-age' => 'required|numeric|min:18',
                'campers-count' => 'required|numeric|min:1|max:6',
                'camp-type' => 'required|numeric|min:0|max:' . sizeof($campingTypes),
                'cg-campsite-value' => 'required|regex:/^\w-\d+$/', // the selected campsite
            ],
            [ // messages
                'camp-type.required' => 'You must select a :attribute',
                'cg-campsite-value.required' => 'You must select a :attribute'
            ],
            [ // names
                'user-name-first' => 'first name',
                'user-name-last' => 'last name',
                'user-email' => 'email',
                'user-phone' => 'phone number',
                'user-age' => 'age',
                'campers-count' => 'campers',
                'camp-type' => 'camping type',
                'cg-campsite-value' => 'campsite',
            ]
        );
        if ($validator->fails()) {
            return redirect('reserve')->withErrors($validator)->withInput();
        }

        $errors = $validator->errors();
        $inputs = [
            'user' => [
                'name-first' => $r->input('user-name-first'),
                'name-last' => $r->input('user-name-last'),
                'email' => $r->input('user-email'),
                'phone' => $r->input('user-phone'),
                'age' => intval($r->input('user-age')),
            ],
            'campsite' => $r->input('cg-campsite-value'),
            'campers' => intval($r->input('campers-count')),
            'dates' => $r->input('dates'),
            'camp-type' => intval($r->input('camp-type')),
        ];

        $sp = explode('-', $inputs['campsite']);
        $campground = Campground::where('section', $sp[0])->where('number', $sp[1]);
        if (!$campground->count()) { // could not find any campgrounds identified with the specified {section-number}
            $errors->add('cg-campsite-value', 'Unknown campsite selected');
            return redirect('/reserve')->withErrors($validator)->withInput();
        }

        $sp = explode(' - ', $inputs['dates']);
        $date_in = strtotime($sp[0]);
        $date_out = strtotime($sp[1]);
        if (!$date_in || !$date_out || $date_in > $date_out) {
            $errors->add('dates', 'System failed to understand the selected dates');
            return redirect('/reserve')->withErrors($validator)->withInput();
        }
        // convert from (seconds -> minutes -> hours -> days)
        $nights = (($date_out - $date_in) / 60 / 60 / 24);
        if ($nights < 1) {
            $errors->add('dates', 'Reservation must be at least 1 night long');
            return redirect('/reserve')->withErrors($validator)->withInput();
        }

        $reservations = ReservationUtil::getReservations($inputs['campsite'], $date_in, $date_out)->get();
        // find all reservations during a specified date range
        if ($reservations->count() > 0) {
            foreach ($reservations as $row) {
                // if a reservation is found under the 'paid' status, it cannot be reserved
                if ($row->status == 'paid') {
                    $errors->add('campsite', 'The campsite is already booked on that date.');
                    return redirect('/reserve')->withErrors($validator)->withInput();
                }

                // if a reservation is found at this point, its status is either 'unpaid' or 'pending'
                // in both cases the reservation is unimportant and can be disposed after a certain amount of time
                $diff = now()->diff($row->updated_at);
                $lifetime = config('session.reservation_lifetime');

                // check if enough time has passed to allow someone else to reserve
                if ($diff->i >= $lifetime) {
                    // sufficient time has passed, delete old data
                    Reservation::destroy($row->id);
                    break; // allow reservation
                } else {
                    $reservation = session('reservation');
                    // check if the current user is the person holding the reservation spot
                    if ($reservation && $reservation->id == $row->id) {
                        // user submitted again when the previous is incomplete; delete the previous data
                        if ($reservation->status == 'pending') {
                            $reservation->delete();
                            session()->forget('reservation');
                            session()->forget('campers');
                            break; // allow reservation
                        }
                    }
                    // not enough time has passed and the reservation doesn't belong to the current user
                    $errors->add('cg-campsite-value', 'Another person is reserving that campsite. Please try again in ' . ($lifetime - $diff->i) . ' minutes');
                    return redirect('/reserve')->withErrors($validator)->withInput();
                }
            }
        }

        // initialize reservation ORM object
        $reservation = new Reservation();
        $reservation->first_name = $inputs['user']['name-first'];
        $reservation->last_name = $inputs['user']['name-last'];
        $reservation->email = $inputs['user']['email'];
        $reservation->phone = $inputs['user']['phone'];
        $reservation->age = $inputs['user']['age'];

        $reservation->camping_type = $inputs['camp-type'];
        $reservation->campground_id  = $inputs['campsite'];

        $reservation->date_in = $date_in;
        $reservation->date_out = $date_out;

        $campers = array();
        $camper = new Camper();
        $camper->first_name = $inputs['user']['name-first'];
        $camper->last_name = $inputs['user']['name-last'];
        array_push($campers, $camper);

        // '-1' because member above is created manually
        $count = $r->input('campers') - 1;
        for ($i = 0; $i < $count; $i++) {
            $camper = new Camper();
            $camper->first_name = $r->input('camper-name-first-' . $i);
            $camper->last_name = $r->input('camper-name-last-' . $i);
            array_push($campers, $camper);
        }

        session([
            'reservation' => $reservation,
            'campers' => $campers,
        ]);

        return redirect('/reserve/checkout');
    }

    public function checkout()
    {
        $reservation = session('reservation', null);
        if (!$reservation) return redirect('/reserve');

        $reservation->status = "pending";
        $reservation->save();

        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
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

        session(['checkout_session' => $checkout_session]);
        session(['email_ts' => 0]); // reset email timestamp

        return view('public.reserve.checkout', ['checkout_session' => $checkout_session]);
    }

    public function success()
    {
        $reservation = session('reservation');
        if (!$reservation) return redirect('/reserve');
        $campers = session('campers');
        $checkout_session = session('checkout_session');
        $email_ts = session('email_ts');

        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
        $checkout_session = $stripe->checkout->sessions->retrieve($checkout_session->id, []);

        if ($checkout_session->payment_status == 'paid') {
            $reservation->transaction_id = $checkout_session->id;
            $reservation->save();
            foreach ($campers as $camper) {
                $camper->reservation_id = $reservation->id;
                $camper->save();
            }


            $send_email = true;
            $email_wait = 0;
            if ($email_ts) {
                $email_wait = $email_ts->diffInMinutes(now());
                if ($email_wait < 3) {
                    $send_email = false;
                }
            }
            if ($send_email) {
                session(['email_ts' => now()]);
                $email_wait = 0;
                // send to customer & administrator
                Mail::to($reservation->email)
                    ->bcc(config('mail.bcc'))
                    ->queue(new ReservationBooking($reservation));
            }

            return view('public.reserve.success', [
                'reservation' => $reservation,
                'email_wait' => 3 - $email_wait,
            ]);
            // view outgoing-email reservation
            // return view('email.reservation', ['reservation' => $reservation]);
        }
        abort(404);
    }
}
