<?php

namespace App\Helper;

use App\Models\Reservation;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ReservationUtil
{

    public static function getNights(Reservation $reservation)
    {
        $arrival = strtotime($reservation->date_in);
        $depature = strtotime($reservation->date_out);
        return ($depature - $arrival) / 60 / 60 / 24;
    }

    public static function getCost(Reservation $reservation)
    {
        $cost = 0;
        switch ($reservation->camping_type) {
            case 0: // single tent
            case 1: // second tent
                $cost = 39;
                break;
            case 2: // rv spot
                $cost = 69;
                break;
        }
        $cost *= ReservationUtil::getNights($reservation);
        // flat fee for the second tent
        if ($reservation->camping_type == 1) $cost += 30;
        return $cost;
    }

    public static function getCampgrounds()
    {
        $geomap = '';
        if (Storage::disk('local')->exists('geomap.json')) {
            $geomap = Storage::disk('local')->get('geomap.json');
        }
        return Response::json(json_decode('[' . $geomap . ']'));
    }

    public static function getMaxReservations() {
        // return sizeof(ReservationUtil::getCampgrounds());
        return 100;
    }
}
