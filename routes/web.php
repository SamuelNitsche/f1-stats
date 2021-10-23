<?php

use App\Models\Driver;
use App\Models\Round;
use App\Models\Season;
use App\Models\Track;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/seasons', function () {
    return view('seasons.index', [
        'seasons' => Season::all(),
    ]);
})->name('seasons.index');

Route::get('/seasons/{season:year}', function (Season $season) {
    return view('seasons.show', [
        'season' => $season,
    ]);
})->name('seasons.show');

Route::get('/seasons/{season:year}/{round:round}', function (Season $season, Round $round) {
    return view('rounds.show', [
        'round' => $round,
    ]);
})->name('rounds.show');

Route::get('/drivers', function () {
    return view('drivers.index', [
        'drivers' => Driver::all(),
    ]);
})->name('drivers.index');

Route::get('/drivers/{driver:slug}', function (Driver $driver) {
    return view('drivers.show', [
        'driver' => $driver,
    ]);
})->name('drivers.show');

Route::get('/tracks', function () {
    return view('tracks.index', [
        'tracks' => Track::all(),
    ]);
})->name('tracks.index');

Route::get('/tracks/{track:slug}', function (Track $track) {
    return view('tracks.show', [
        'track' => $track,
    ]);
})->name('tracks.show');
