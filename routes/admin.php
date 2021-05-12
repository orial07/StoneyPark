<?php
// must be logged-in and verified

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CampgroundsController;
use App\Http\Controllers\Admin\RulesController;
use App\Http\Controllers\Auth\ReservationsController;
use Illuminate\Support\Facades\Route;

Route::name('admin') // all route names will be prefixed with
    ->prefix('admin') // all route URL will be prefixed with
    ->middleware(['auth', 'verified', 'webadmin']) // user must be a web-admin
    ->group(function () {

        // main page; admin
        Route::get('/', function () {
            return view('admin.main');
        });

        // rules group; admin.rules
        Route::name('.rules')
            ->prefix('rules')
            ->group(function () {
                Route::get('/', [RulesController::class, 'show']);
                Route::get('/create', [RulesController::class, 'create'])->name('.create');

                Route::post('/save', [RulesController::class, 'save'])->name('.save');
                Route::get('/edit/{id}', [RulesController::class, 'edit'])->name('.edit');
                Route::get('/delete/{id}', [RulesController::class, 'delete'])->name('.delete');
            });

        // reservations group; admin.reservations
        Route::name('.reservations')
            ->prefix('reservations')
            ->group(function () {
                Route::get('/', [ReservationsController::class, 'search']);
                Route::post('/', [ReservationsController::class, 'search'])->name('search');
            });

        // map group; admin.map
        Route::name('.campgrounds')
            ->prefix('campgrounds')
            ->group(function () {
                Route::get('/', [CampgroundsController::class, 'show']);
            });

        // gallery group; admin.gallery
        Route::name('.gallery')
            ->prefix('gallery')
            ->group(function () {
                Route::get('/', [GalleryController::class, 'show']);
                Route::post('/upload', [GalleryController::class, 'upload'])->name('.upload');
                Route::post('/delete', [GalleryController::class, 'delete'])->name('.delete');
            });
    });
