<?php

namespace App\Http\Controllers;

use App\Mail\ReservationBooking;
use Illuminate\Http\Request;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReserveController extends Controller
{
    public function show()
    {
        return view('reserve');
    }

    public function submit(Request $r)
    {
        Validator::make(
            $r->all(),
            [ // rules
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                // https://stackoverflow.com/questions/16699007/regular-expression-to-match-standard-10-digit-phone-number
                'phone' => 'required|regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/',
                'age' => 'required|numeric|min:18',

                'date_in' => 'required|date',
                'date_out' => 'required|date|after:date_in',

                'campingType' => 'requried|numeric|min:0|max:2',
                'campers' => 'requried|numeric|min:0|max:6',
            ],
            [ // messages
            ],
            [ // attributes
            ]
        );

        $data = [
            'customer' => [
                'firstName' => $r->input('first_name'),
                'lastName' => $r->input('last_name'),
                'email' => $r->input('email'),
                'phone' => $r->input('phone'),
                'age' => $r->input('age'),
            ],
            'date_in' => strtotime($r->input('date_in')),
            'date_out' => strtotime($r->input('date_out')),
            'members' => array(),
        ];


        $campingType = $data['campingType'] = $r->input('campingType');

        // convert from seconds -> minutes -> hours -> days
        $nights = $data['nights'] = ($data['date_out'] - $data['date_in']) / 60 / 60 / 24;

        array_push($data['members'], [
            'firstName' => $data['customer']['firstName'],
            'lastName' => $data['customer']['lastName'],
        ]);

        $campersCount = $r->input('campers') - 1;
        for ($i = 0; $i < $campersCount; $i++) {
            array_push($data['members'], [
                'firstName' => $r->input('camper' . $i . '_first_name'),
                'lastName' => $r->input('camper' . $i . '_last_name'),
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

        // return view('email.reservation', $data);
        Mail::to(env('MAIL_TO_ADDRESS'))->queue(new ReservationBooking($data));
        return redirect('/reserve')->withErrors(['success' => 'success']);
    }
}
