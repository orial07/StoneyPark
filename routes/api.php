<?php

use App\Helper\ReservationUtil;
use App\Models\Campground;
use App\Models\Reservation;
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

Route::post('/cg/get', function () {
    return DB::table('campgrounds')
        ->orderBy('section')
        ->orderBy('number')
        ->get();
});

Route::post('/cg/status', function (Request $r) {
    $dates = explode(' - ', $r->input('dates'));

    $date_in = strtotime($dates[0]);
    $date_out = strtotime($dates[1]);
    $date_in = date('Y-m-d H:i', $date_in);
    $date_out = date('Y-m-d H:i', $date_out);

    $result = Reservation::select(['campground_id'])
        ->where('date_in', '>=', $date_in)
        ->where('date_out', '<=', $date_out)
        ->get();
    return json_encode($result);
});

Route::post('/cg/get/{section}/{number}', function ($section, $number) {
    $result = DB::table('campgrounds')
        ->select(['section', 'number', 'has_fire', 'has_table'])
        ->where([
            'section' => $section,
            'number' => $number,
        ])
        ->get();
    return json_encode($result);
});

Route::post('/cg/reserved/{section}/{number}', function (Request $r, $section, $number) {
    $dates = explode(' - ', $r->input('dates'));

    $date_in = strtotime($dates[0]);
    $date_out = strtotime($dates[1]);
    $campground = $section . '-' . $number;
    return ReservationUtil::isCampgroundReserved($campground, $date_in, $date_out);
});
