<?php

namespace App\Console\Commands;

use App\Models\Round;
use App\Models\Season;
use App\Models\Track;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class SyncRoundsCommand extends Command
{
    protected $signature = 'f1:rounds:sync';

    protected $description = 'Sync all F1 rounds';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $seasons = Season::all();
        $tracks = Track::all();

        $seasons->map(function (Season $season) use ($tracks) {
            $rounds = $this->service->getAllRounds($season->year);

            $rounds = collect($rounds)->map(fn($round) => [
                'season_id' => $season->id,
                'track_id' => $tracks->firstWhere('slug', $round['Circuit']['circuitId'])->id,
                'round' => $round['round'],
                'name' => $round['raceName'],
                'wikipedia_url' => $round['url'],
            ])->toArray();

            Round::upsert($rounds, ['season_id', 'round', 'track_id', 'name']);
        });

        return Command::SUCCESS;
    }
}
