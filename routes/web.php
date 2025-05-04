<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\ServicesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect()->route('home');
});


Route::middleware(['auth'])->group(function(){

    Route::get('reservations', [ReservationsController::class, 'index'])->name('reservations.index');
    Route::delete('reservations/{reservation}', [ReservationsController::class, 'destroy'])->name('reservations.destroy');
    Route::get('services/{service}/reservations/create', [ReservationsController::class, 'create'])->name('services.reservations.create');
    Route::post('services/{service}/reservations', [ReservationsController::class, 'store'])->name('services.reservations.store');
    Route::resource('services', ServicesController::class);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
