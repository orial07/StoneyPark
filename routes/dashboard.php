<?php
// must be logged-in and verified

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    // dashboard group
    Route::prefix('dashboard')->group(function () {
        // public page
        Route::get('/', [DashboardController::class, 'show'])->name('dashboard');

        // view a specific reservation
        Route::get('/reservation/{id}', [DashboardController::class, 'showReservation'])->name('dashboard.reservation');

        // must be web-admin
        Route::middleware(['webadmin'])->group(function () {

            // view all reservations
            Route::get('/reservations', [DashboardController::class, 'showReservations'])->name('dashboard.reservations');
            // filter view reservations
            Route::get('/reservations/search', [DashboardController::class, 'searchReservation'])->name('dashboard.reservations.search'); // search filter

            // edit map
            Route::get('/map', [MapController::class, 'show'])->name('dashboard.map');
            Route::post('/map/save', [MapController::class, 'save']);

            // edit rules
            Route::get('/rules', [DashboardController::class, 'showRules'])->name('dashboard.rules');
            Route::post('/rules', [DashboardController::class, 'editRules'])->name('dashboard.rules.submit');

            // edit gallery
            Route::get('/gallery', [GalleryController::class, 'show'])->name('dashboard.gallery');
            Route::post('/gallery/upload', [GalleryController::class, 'upload'])->name('dashboard.gallery.upload');
            Route::post('/gallery/delete', [GalleryController::class, 'delete'])->name('dashboard.gallery.delete');
        });
    });
});
