<?php
use App\Http\Controllers\Auth\Admin\RulesController;
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

                Route::get('/send-email/{id}', [ReservationsController::class, 'sendEmail'])->name('.email');

                Route::get('/cancel/{id}', [ReservationsController::class, 'cancel'])->name('.cancel');
                Route::get('/resume/{id}', [ReservationsController::class, 'resume'])->name('.resume');

                Route::post('/update/{id}', [ReservationsController::class, 'update'])->name('.update');
            });
    });
