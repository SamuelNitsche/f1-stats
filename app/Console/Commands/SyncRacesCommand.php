<?php

namespace App\Console\Commands;

use App\Models\Driver;
use App\Models\Race;
use App\Models\Round;
use App\Models\Track;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class SyncRacesCommand extends Command
{
    protected $signature = 'f1:races:sync';

    protected $description = 'Sync all F1 races';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $tracks = Track::all();
        $drivers = Driver::all();
        $rounds = Round::all();

        $rounds->map(function (Round $round) use ($tracks, $drivers) {
            $apiRace = $this->service->getRace(season: $round->season->year, round: $round->round);

            if (empty($apiRace)) {
                return;
            }

            $race = collect($apiRace)->map(fn($apiRace) => [
                'season_id' => $round->season_id,
                'round_id' => $round->id,
                'track_id' => $tracks->firstWhere('slug', $apiRace['Circuit']['circuitId'])->id,
            ])->first();

            $race = Race::updateOrCreate($race, $race);

            $results = collect($apiRace[0]['Results'])->map(fn($result) => [
                'driver_id' => $drivers->firstWhere('slug', $result['Driver']['driverId'])->id,
                'round_id' => $round->id,
                'track_id' => $race->track_id,
                'race_id' => $race->id,
                'position' => $result['position'],
                'grid' => $result['grid'],
                'status' => $result['status'],
                'laps' => $result['laps'],
                'points' => $result['points'],
                'total_time_millis' => $result['Time']['millis'] ?? null,
                'total_time' => $result['Time']['time'] ?? null,
                'fastest_lap_time' => $result['FastestLap']['Time']['time'] ?? null,
                'fastest_lap_number' => $result['FastestLap']['lap'] ?? null,
                'fastest_lap_rank' => $result['FastestLap']['rank'] ?? null,
            ]);

            $race->drivers()->sync($results);
        });

        return Command::SUCCESS;
    }
}
