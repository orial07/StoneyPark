<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ReservationController;
use App\Http\Controllers\Controller;
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
Route::post('/contact', [Controller::class, 'contact_send'])->name('contact.send');

Route::get('/gallery', [GalleryController::class, 'show'])->name('gallery');

Route::name('reserve')
    ->prefix('reserve')
    ->group(function () {
        Route::get('/', [ReserveController::class, 'show']);
        Route::post('/', [ReserveController::class, 'submit'])->name('.submit'); // reservation form validator

        Route::get('/checkout', [ReserveController::class, 'checkout'])->name('.checkout'); // reservation payment
        Route::get('/success', [ReserveController::class, 'success'])->name('.success'); // reservation payment success
    });


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/account', [ProfileController::class, 'show'])->name('account');
    Route::get('/reservation/{id}', [ReservationController::class, 'show'])->name('reservation');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
