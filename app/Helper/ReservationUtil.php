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
                'tent' => '1 Medium Tent (4 - 6 people)',
            ]),
            new CampingType('Extra Medium Tent', 45, 25, [
                'tent' => '2 Medium Tents (up to 12 people)',
            ], 2),
            // new CampingType("Recreation Vehicle", 69, 0, "One recreational vehicle (RV) allowed on campsite."),
        );
    }

    /**
     * Get all reservations for a specified campground within a date range.
     * 
     * @param string $campground The campground identifier (letter-number)
     * @param int $date_in The arrival date
     * @param int $date_out The departure date
     * @return \Illuminate\Database\Query\Builder
     */
    public static function getReservations($campground, $date_in, $date_out)
    {
        if (!$date_in || !$date_out || $date_in > $date_out) {
            throw new Exception('Invalid dates provided.');
        }
        // convert from (seconds -> minutes -> hours -> days)
        $nights = (($date_out - $date_in) / 60 / 60 / 24);
        if ($nights < 1) {
            throw new Exception('Same arrival and departure date provided.');
        }

        $date_in = date('Y-m-d 23:59:59', $date_in);
        $date_out = date('Y-m-d 23:59:59', $date_out);

        return Reservation::select()
            ->where('campground_id', $campground)
            // find reservations that start before, and continue during the requested date
            ->where(function ($query) use ($date_in) {
                $query->where('date_in', '<=', $date_in); // inclusive; reservations start
                $query->where('date_out', '>', $date_in); // exclusive; reservations end
            })
            // find reservations that start after the requested date
            ->orWhere(function ($query) use ($date_in) {
                $query->where('date_in', '>=', $date_in); // inclusive; reservations start
            })
            ->get();
    }
}
