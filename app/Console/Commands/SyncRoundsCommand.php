<?php

namespace App\Console\Commands;

use App\Models\Circuit;
use App\Models\Round;
use App\Models\Season;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SyncRoundsCommand extends Command
{
    protected $signature = 'f1:rounds:sync {year?}';

    protected $description = 'Sync all F1 rounds';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $seasonsQuery = Season::query();
        $tracks = Circuit::all();

        if ($year = $this->argument('year')) {
            $seasons = $seasonsQuery->where('year', $year)->get();
        } else {
            $seasons = $seasonsQuery->get();
        }

        $seasons->map(function (Season $season) use ($tracks) {
            $rounds = $this->service->getAllRounds($season->year);

            $rounds = collect($rounds)->map(fn ($round) => [
                'season_id' => $season->id,
                'track_id' => $tracks->firstWhere('slug', $round['Circuit']['circuitId'])->id,
                'round' => $round['round'],
                'name' => $round['raceName'],
                'date' => Carbon::parse($round['date'].' '.$round['time']),
                'wikipedia_url' => $round['url'],
            ])->toArray();

            Round::upsert($rounds, ['season_id', 'round', 'track_id', 'name']);
        });

        return Command::SUCCESS;
    }
}
