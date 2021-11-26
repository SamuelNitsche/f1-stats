<?php

namespace App\Console\Commands;

use App\Models\Season;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class SyncSeasonsCommand extends Command
{
    protected $signature = 'f1:seasons:sync';

    protected $description = 'Sync all F1 seasons';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $seasons = $this->service->getAllSeasons();

        $seasons = collect($seasons)->map(function ($season) {
            if (intval($season['season']) < 2019) {
                return [];
            }

            return [
                'year' => $season['season'],
                'wikipedia_url' => $season['url'],
            ];
        })->filter()->toArray();

        Season::upsert($seasons, 'year');

        return Command::SUCCESS;
    }
}
