<?php

namespace App\Console\Commands;

use App\Models\Circuit;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class SyncTracksCommand extends Command
{
    protected $signature = 'f1:tracks:sync';

    protected $description = 'Sync all F1 tracks';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $tracks = $this->service->getAllTracks();

        $tracks = collect($tracks)->map(function ($track) {
            return [
                'slug' => $track['circuitId'],
                'name' => $track['circuitName'],
                'wikipedia_url' => $track['url'],
                'lat' => $track['Location']['lat'],
                'lon' => $track['Location']['long'],
                'locality' => $track['Location']['locality'],
                'country' => $track['Location']['country'],
            ];
        })->toArray();

        Circuit::upsert($tracks, 'trackid');

        return Command::SUCCESS;
    }
}
