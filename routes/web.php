<?php

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

Route::get('/reserve', [ReserveController::class, 'show'])->name('reserve');
Route::post('/reserve', [ReserveController::class, 'submit'])->name('reserve.submit');

Route::get('/gallery', [GalleryController::class, 'show'])->name('gallery');

Route::middleware(['auth', 'webadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/dashboard/home', [DashboardController::class, 'show'])->name('dashboard.home');

    Route::get('/dashboard/rules', [DashboardController::class, 'showRules'])->name('dashboard.rules');
    Route::post('/dashboard/rules', [DashboardController::class, 'editRules'])->name('dashboard.rules.submit');

    Route::get('/dashboard/gallery', [DashboardController::class, 'showGallery'])->name('dashboard.gallery');
    Route::post('/dashboard/gallery', [DashboardController::class, 'editGallery'])->name('dashboard.gallery.submit');
});

require __DIR__ . '/auth.php';
