<?php

use App\Helper\ReservationUtil;
use App\Models\Campground;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Get all campgrounds
 */
Route::post('/cg/get', function () {
    return Campground::select()
        ->orderBy('section')
        ->orderBy('number')
        ->get();
});

/**
 * Get descriptive information about a campground
 */
Route::post('/cg/get/{section}/{number}', function ($section, $number) {
    $result = Campground::select(['has_fire', 'has_table'])
        ->where([
            'section' => $section,
            'number' => $number,
        ])->get();
    return json_encode($result);
});

/**
 * Get status of all campgrounds during a specified date
 */
Route::post('/cg/status', function (Request $r) {
    $dates = explode(' - ', $r->input('dates'));

    $date_in = strtotime($dates[0]);
    $date_out = strtotime($dates[1]);

    return json_encode(ReservationUtil::getReservations(
        ['campground_id', 'updated_at', 'status'],
        $date_in,
        $date_out
    )->get());
});
