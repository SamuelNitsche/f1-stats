<?php

namespace App\Console\Commands;

use App\Models\Driver;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class SyncDriversCommand extends Command
{
    protected $signature = 'f1:drivers:sync';

    protected $description = 'Sync all F1 drivers';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {
        $drivers = $this->service->getAllDrivers();

        $drivers = collect($drivers)->map(fn($driver) => [
            "slug" => $driver['driverId'],
            "first_name" => $driver['givenName'],
            "last_name" => $driver['familyName'],
            "date_of_birth" => $driver['dateOfBirth'],
            "nationality" => $driver['nationality'],
            "wikipedia_url" => $driver['url'],
        ])->toArray();

        Driver::upsert($drivers, 'slug');

        return Command::SUCCESS;
    }
}
