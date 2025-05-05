<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\ReservationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

//  Route::post('test', function(){
//     dd('asasas');
//  });
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group( function () {

    Route::get('reservations', [ReservationsController::class, 'index'])->name('reservations.index');
    Route::delete('reservations/{reservation}', [ReservationsController::class, 'destroy'])->name('reservations.destroy');
    Route::get('services/{service}/reservations/create', [ReservationsController::class, 'create'])->name('services.reservations.create');
    Route::post('services/{service}/reservations', [ReservationsController::class, 'store'])->name('services.reservations.store');

    Route::resource('services', ServicesController::class)->only(['index']);

});
