<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\RulesController;

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
Route::get('/gallery', [GalleryController::class, 'show'])->name('gallery');
Route::get('/contact', [Controller::class, 'contact'])->name('contact');

Route::prefix('reserve')->group(function () {
    Route::get('/', [ReserveController::class, 'show'])->name('reserve'); // reservation form
    Route::post('/', [ReserveController::class, 'submit'])->name('reserve.submit'); // reservation form validator

    Route::get('/checkout', [ReserveController::class, 'checkout'])->name('reserve.checkout'); // reservation payment
    Route::get('/success', [ReserveController::class, 'success'])->name('reserve.success'); // reservation payment success
    Route::get('/cancel', [ReserveController::class, 'cancel'])->name('reserve.cancel'); // reservation payment cancelled
});


Route::middleware(['auth', 'webadmin'])->group(function () {

    Route::prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'show'])->name('dashboard');

        Route::get('/reservation/{id}', [DashboardController::class, 'showReservation'])->name('dashboard.reservation');
        Route::get('/reservations', [DashboardController::class, 'showReservations'])->name('dashboard.reservations');
    
        Route::get('/home', [DashboardController::class, 'showHome'])->name('dashboard.home');
        Route::post('/home', [DashboardController::class, 'editHome'])->name('dashboard.home.submit');
    
        Route::get('/rules', [DashboardController::class, 'showRules'])->name('dashboard.rules');
        Route::post('/rules', [DashboardController::class, 'editRules'])->name('dashboard.rules.submit');
    
        Route::get('/gallery', [DashboardController::class, 'showGallery'])->name('dashboard.gallery');
        Route::post('/gallery', [DashboardController::class, 'editGallery'])->name('dashboard.gallery.submit');
    });
});

require __DIR__ . '/auth.php';
