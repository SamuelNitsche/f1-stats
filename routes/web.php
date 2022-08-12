<?php

use App\Http\Controllers\CircuitsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RacesController;
use App\Http\Controllers\SeasonsController;
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

Route::get('/', IndexController::class)->name('home');

Route::prefix('seasons')->group(function () {
    Route::get('/', [SeasonsController::class, 'index'])->name('seasons.index');
    Route::get('/{season:year}', [SeasonsController::class, 'show'])->name('seasons.show');
    Route::get('/seasons/{season:year}/{race:round}', [RacesController::class, 'index'])->name('rounds.show');
});

Route::prefix('drivers')->group(function () {
    Route::get('/', [DriversController::class, 'index'])->name('drivers.index');
    Route::get('/{driver:driverRef}', [DriversController::class, 'show'])->name('drivers.show');
});

Route::prefix('circuits')->group(function () {
    Route::get('/', [CircuitsController::class, 'index'])->name('circuits.index');
    Route::get('/circuits/{circuit:circuitRef}', [CircuitsController::class, 'show'])->name('circuits.show');
});

