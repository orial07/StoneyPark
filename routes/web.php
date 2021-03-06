<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReserveController;
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

Route::get('/', [MainController::class, 'show']);
Route::get('/rules', [Controller::class, 'rules']);
Route::get('/gallery', [Controller::class, 'gallery']);

Route::get('/reserve', [ReserveController::class, 'show']);
Route::post('/reserve', [ReserveController::class, 'submit']);