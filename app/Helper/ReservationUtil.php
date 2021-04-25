<?php

namespace App\Helper;

use App\Models\Reservation;
use App\Objects\CampingType;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ReservationUtil
{
    public static function getCampingTypes()
    {
        return array(
            new CampingType("Single Medium Tent", 45, 0, "One tent allowed on campsite."),
            new CampingType("Extra Medium Tent", 45, 25, "Two tents allowed on campsite.", 2),
            // new CampingType("Recreation Vehicle", 69, 0, "One recreational vehicle (RV) allowed on campsite."),
        );
    }

    public static function getNights(Reservation $reservation)
    {
        $arrival = strtotime($reservation->date_in);
        $depature = strtotime($reservation->date_out);
        return ($depature - $arrival) / 60 / 60 / 24;
    }

    public static function getCost(Reservation $reservation)
    {
        $campingTypes = ReservationUtil::getCampingTypes();
        $ct = $campingTypes[$reservation->camping_type];

        $cost = $ct->price;
        $cost *= ReservationUtil::getNights($reservation);
        $cost += $ct->price2;

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

    public static function getMaxReservations()
    {
        // return sizeof(ReservationUtil::getCampgrounds());
        return 100;
    }
}
