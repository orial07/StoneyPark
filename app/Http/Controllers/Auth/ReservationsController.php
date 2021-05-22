<?php

namespace App\Http\Controllers\Auth;

use App\Helper\ReservationUtil;
use App\Http\Controllers\Controller;
use App\Mail\ReservationBooking;
use App\Models\Campground;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReservationsController extends Controller
{
    public function show($id)
    {
        $reservation = Reservation::find($id);
        // throw 404 if not found or user doesn't have permission to view
        if (!$reservation || auth()->user()->web_admin == 0 && strcmp($reservation->email, auth()->user()->email) != 0) {
            abort(404);
        }

        return view('auth.reservation', [
            'reservation' => $reservation,
            'checkout' => $reservation->getCheckoutSession(),
        ]);
    }

    public function search(Request $r)
    {
        $db = DB::table('reservations');

        if (sizeof($r->all()) > 0) {
            $validator = Validator::make(
                $r->all(),
                [
                    'search' => 'string',
                    'page' => 'string',
                ]
            );
            if ($validator->fails()) {
                return redirect('/admin/reservations')->withErrors($validator)->withInput();
            }
            $search = $r->input('search');
            $n = intval($search);

            if ($n > 0) {
                return redirect(url('reservation', $n));
            } else {
                $search = $search . '%';
                $db->where('first_name', 'like', $search)
                    ->orWhere('last_name', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('status', 'like', $search)
                    ->orWhere('campground_id', 'like', $search);
            }
        }

        return view('admin.reservations', [
            'reservations' => $db
                ->orderBy('id')
                ->orderBy('email')
                ->paginate(20)
        ]);
    }

    public function update(Request $r, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) abort(404);

        $inputs = [
            'dates' => $r->input('dates'),
            'cg-campsite-value' => $r->input('cg-campsite-value'),
        ];

        $sp = explode(' - ', $inputs['dates']);
        $date_in = strtotime($sp[0]);
        $date_out = strtotime($sp[1]);

        $sp = explode('-', $inputs['cg-campsite-value']);
        $section = $sp[0];
        $number = $sp[1];

        $campsite = Campground::where('section', $section)->where('number', $number)->count();
        if (!$campsite) {
            return redirect()->back()->withErrors(['cg-campsite-value' => sprintf('Invalid campsites selected (%s)', $inputs['cg-campsite-value'])]);
        }

        $nights = ReservationUtil::getCountNights($date_in, $date_out);
        if ($nights != $reservation->getNights()) {
            return redirect()->back()->withErrors(['dates' => sprintf(
                'Number of nights do not match (should be %d but given %d)',
                $reservation->getNights(),
                $nights
            )]);
        }

        $reservations = ReservationUtil::getReservations(
            ['id', 'updated_at', 'status'],
            $date_in,
            $date_out
        )->where('campground_id', $inputs['cg-campsite-value'])->get();

        if ($reservations->count() > 0) {
            foreach ($reservations as $row) {
                // if a reservation is found under the 'paid' status, it cannot be reserved
                if ($row->status == 'paid') {
                    return redirect()->back()->withErrors(['dates' => 'A campsite is already reserved on that date.'])->withInput();
                }

                if ($row->status != 'canceled') {
                    // if a reservation is found at this point, its status is either 'unpaid' or 'pending'
                    // in both cases the reservation is unimportant and can be disposed after a certain amount of time
                    $diff = now()->diff($row->updated_at);
                    $lifetime = config('session.reservation_lifetime');

                    // check if enough time has passed to allow someone else to reserve
                    if ($diff->i < $lifetime) {
                        return redirect()->back()->withErrors(['dates' => 'A campsite is currently being reserved on that date.'])->withInput();
                    }
                }
            }
        }

        $reservation->date_in = date('Y-m-d H:i:s', $date_in);
        $reservation->date_out = date('Y-m-d H:i:s', $date_out);
        $reservation->campground_id = $inputs['cg-campsite-value'];
        $reservation->save();

        return redirect()->back()->withErrors(['success' => 'Reservation updated successfully']);
    }

    public function sendEmail($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) abort(404);

        Mail::to($reservation->email)
            ->bcc(config('mail.bcc'))
            ->queue(new ReservationBooking($reservation));

        return redirect('/reservation/' . $reservation->id)->withErrors(['success' => 'Email sent!']);
    }

    public function cancel($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) abort(404);

        $reservation->status = 'canceled';
        $reservation->save();

        return redirect()->back()->withErrors(['success' => 'Reservation canceled']);
    }

    public function resume($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) abort(404);

        $reservations = ReservationUtil::getReservations(
            ['id', 'updated_at', 'status'],
            strtotime($reservation->date_in),
            strtotime($reservation->date_out)
        )->where('campground_id', $reservation->campground_id)->get();

        if ($reservations->count() > 0) {
            foreach ($reservations as $row) {
                // if a reservation is found under the 'paid' status, it cannot be reserved
                if ($row->status == 'paid') {
                    return redirect()->back()->withErrors(['dates' => 'A campsite is already reserved on that date.'])->withInput();
                }

                if ($row->status != 'canceled') {
                    // if a reservation is found at this point, its status is either 'unpaid' or 'pending'
                    // in both cases the reservation is unimportant and can be disposed after a certain amount of time
                    $diff = now()->diff($row->updated_at);
                    $lifetime = config('session.reservation_lifetime');


                    // check if enough time has passed to allow someone else to reserve
                    if ($diff->i < $lifetime) {
                        return redirect()->back()->withErrors(['dates' => 'A campsite is currently being reserved on that date.'])->withInput();
                    }
                }
            }
        }

        $reservation->status = 'paid';
        $reservation->save();

        return redirect()->back()->withErrors(['success' => 'Reservation resumed']);
    }
}
