<?php

namespace App\Console\Commands;

use App\Models\Circuit;
use App\Models\Driver;
use App\Models\Qualification;
use App\Models\Round;
use App\Models\Season;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class SyncQualificationsCommand extends Command
{
    protected $signature = 'f1:qualifications:sync {year?}';

    protected $description = 'Sync all F1 qualifications';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $tracks = Circuit::all();
        $drivers = Driver::all();
        $roundsQuery = Round::query()->with('season');

        if ($year = $this->argument('year')) {
            $rounds = $roundsQuery->where('season_id', Season::where('year', $year)->first()->id)->get();
        } else {
            $rounds = $roundsQuery->get();
        }

        $rounds->map(function (Round $round) use ($tracks, $drivers) {
            $apiQualification = $this->service->getQualification(season: $round->season->year, round: $round->round);

            if (empty($apiQualification)) {
                return;
            }

            $qualification = collect($apiQualification)->map(fn ($apiQualification) => [
                'season_id' => $round->season_id,
                'round_id' => $round->id,
                'circuit_id' => $tracks->firstWhere('slug', $apiQualification['Circuit']['circuitId'])->id,
            ])->first();

            //dd($qualification);

            $qualification = Qualification::updateOrCreate($qualification, $qualification);

            $results = collect($apiQualification[0]['QualifyingResults'])->map(fn ($result) => [
                'driver_id' => $drivers->firstWhere('slug', $result['Driver']['driverId'])->id,
                'circuit_id' => $qualification->circuit_id,
                'qualification_id' => $qualification->id,
                'position' => $result['position'],
                'q1_time' => $result['Q1'],
                'q2_time' => $result['Q2'] ?? null,
                'q3_time' => $result['Q3'] ?? null,
            ]);

            $qualification->drivers()->sync($results);
        });

        return Command::SUCCESS;
    }
}
