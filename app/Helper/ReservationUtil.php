<?php

namespace App\Helper;

use App\Models\Reservation;
use Exception;

class ReservationUtil
{
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
        $date_out = date('Y-m-d 00:00:00', $date_out);

        return Reservation::select($columns)
            ->where('date_in', '<', $date_out)
            ->where('date_out', '>=', $date_in);
    }
}
