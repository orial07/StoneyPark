<?php

namespace App\Helper;

use App\Objects\CampingType;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ReservationUtil
{
    public static function getCampingTypes()
    {
        return array(
            new CampingType('Single Medium Tent', 45, 0, [
                'tent' => '1 Medium Tent (4 - 6 people)',
                'table' => 'Picnic Table',
                'fire' => 'Firepit',
            ]),
            new CampingType('Extra Medium Tent', 45, 25, [
                'tent' => '2 Medium Tents (8 - 12 people)',
                'table' => 'Picnic Table',
                'fire' => 'Firepit',
            ], 2),
            // new CampingType("Recreation Vehicle", 69, 0, "One recreational vehicle (RV) allowed on campsite."),
        );
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
