<?php

use App\Http\Controllers\Guest\GalleryController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\MapController;
use App\Http\Controllers\Guest\ReserveController;
use App\Http\Controllers\Guest\RulesController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'show']);
Route::get('/rules', [RulesController::class, 'show'])->name('rules');
Route::get('/contact', [Controller::class, 'contact'])->name('contact');
Route::get('/gallery', [GalleryController::class, 'show'])->name('gallery');

Route::post('/map/load', [MapController::class, 'load']);

Route::prefix('reserve')->group(function () {
    Route::get('/', [ReserveController::class, 'show'])->name('reserve'); // reservation form
    Route::post('/', [ReserveController::class, 'submit'])->name('reserve.submit'); // reservation form validator

    Route::get('/checkout', [ReserveController::class, 'checkout'])->name('reserve.checkout'); // reservation payment
    Route::get('/success', [ReserveController::class, 'success'])->name('reserve.success'); // reservation payment success
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
