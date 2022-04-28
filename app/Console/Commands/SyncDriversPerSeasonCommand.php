<?php

namespace App\Console\Commands;

use App\Models\Circuit;
use App\Models\Driver;
use App\Models\Round;
use App\Models\Season;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class SyncDriversPerSeasonCommand extends Command
{
    protected $signature = 'f1:drivers-per-season:sync';

    protected $description = 'Sync all F1 drivers and their driving seasons';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $drivers = Driver::all();
        $seasons = Season::all();

        $seasons->map(function (Season $season) use ($drivers) {
            $apiDrivers = $this->service->getAllDrivers($season->year);

            $mapping = collect($apiDrivers)->map(fn ($driver) => [
                    'driver_id' => $drivers->firstWhere('slug', $driver['driverId'])->id,
                    'season_id' => $season->id,
            ]);

            $season->drivers()->sync($mapping);
        });

        return Command::SUCCESS;
    }
}
