<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Race;
use App\Models\Season;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function __invoke(Season $season, Request $request)
    {
        $drivers = Driver::whereIn('driverRef', explode(',', $request->input('drivers')))->get();

        $data = $season->races->mapWithKeys(function (Race $race) use ($drivers) {
            return [$race->name => $drivers->mapWithKeys(function (Driver $driver) use ($race) {
                return [$driver->driverRef => [
                    'race' => $driver->results->where('raceId', $race->raceId)->first(),
                    'qualification' => $driver->qualifications->where('raceId', $race->raceId)->first(),
                ]];
            })];
        });
//        dd($data);
//
//        $data = $drivers->mapWithKeys(function (Driver $driver) use ($season) {
//            $data = $driver
//                ->races()
//                ->with(
//                    ['results' => fn($query) => $query->where('driverId', $driver->driverId)],
//                )
//                ->with(
//                    ['qualifications' => fn($query) => $query->where('driverId', $driver->driverId)],
//                )
//                ->where('year', $season->year)
//                ->get();
//
//            return [$ra];
//        });

        return view('seasons.compare', [
            'season' => $season,
            'drivers' => $drivers,
            'data' => $data,
        ]);
    }
}
