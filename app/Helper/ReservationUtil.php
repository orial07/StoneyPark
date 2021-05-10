<?php

namespace App\Helper;

use App\Models\Campground;
use App\Objects\CampingType;
use Exception;
use Illuminate\Support\Facades\DB;

class ReservationUtil
{
    public static function getCampingTypes()
    {
        return array(
            new CampingType('Single Medium Tent', 45, 0, [
                'tent' => '1 Medium Tent (4 - 6 people)',
            ]),
            new CampingType('Extra Medium Tent', 45, 25, [
                'tent' => '2 Medium Tents (up to 12 people)',
            ], 2),
            // new CampingType("Recreation Vehicle", 69, 0, "One recreational vehicle (RV) allowed on campsite."),
        );
    }

    /**
     * Check if a campground is in-use on a given reservation date (arrival and departure).
     * 
     * @param string $campground    The campground identifier (letter-number)
     * @param int $date_in     The arrival date
     * @param int $date_out    The departure date
     * @return boolean  true if the campground is reserved, false otherwise
     */
    public static function isCampgroundReserved($campground, $date_in, $date_out)
    {
        if (!$date_in || !$date_out || $date_in > $date_out) {
            throw new Exception('Invalid dates provided.');
        }
        // convert from (seconds -> minutes -> hours -> days)
        $nights = (($date_out - $date_in) / 60 / 60 / 24);
        if ($nights < 1) {
            throw new Exception('Same in and out date provided.');
        }

        $date_in = date('Y-m-d H:i', $date_in);
        $date_out = date('Y-m-d H:i', $date_out);

        $result = DB::table('reservations')
            ->where('campground_id', $campground)
            ->where('date_in', '<', $date_out)
            ->where('date_out', '>', $date_in)
            ->count();

        return json_encode($result);
    }
}
