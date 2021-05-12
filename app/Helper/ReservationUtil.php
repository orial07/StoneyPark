<?php

namespace App\Helper;

use App\Models\Campground;
use App\Models\Reservation;
use App\Objects\CampingType;
use Exception;
use Illuminate\Support\Facades\DB;

class ReservationUtil
{
    public static function getCampingTypes()
    {
        return array(
            new CampingType('Single Medium Tent', 45, 0, [
                'fire' => 'Firepit',
                'table' => 'Picnic table',
                'tent' => '1 Medium Tent (4 - 6 people)',
            ]),
            new CampingType('Extra Medium Tent', 45, 25, [
                'fire' => 'Firepit',
                'table' => 'Picnic table',
                'tent' => '2 Medium Tents (up to 12 people)',
            ], 2),
            // new CampingType("Recreation Vehicle", 69, 0, "One recreational vehicle (RV) allowed on campsite."),
        );
    }

    /**
     * Get all reservations for a specified campground within a date range.
     * 
     * @param array $columns the columns to select from the table
     * @param int $date_in The arrival date
     * @param int $date_out The departure date
     * @return \Illuminate\Database\Query\Builder
     */
    public static function getReservations($columns, $date_in, $date_out)
    {
        if (!$date_in || !$date_out || $date_in > $date_out) {
            throw new Exception('Invalid dates provided.');
        }
        // convert from (seconds -> minutes -> hours -> days)
        $nights = (($date_out - $date_in) / 60 / 60 / 24);
        if ($nights < 1) {
            throw new Exception('Same arrival and departure date provided.');
        }

        $date_in = date('Y-m-d 00:00:00', $date_in);
        $date_out = date('Y-m-d 23:59:59', $date_out);

        return Reservation::select($columns)
            ->where('date_in', '<=', $date_out)
            ->where('date_out', '>=', $date_in);
    }
}
