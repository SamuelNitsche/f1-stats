<?php

namespace App\Console\Commands;

use App\Models\Driver;
use App\Models\Round;
use App\Models\Season;
use App\Models\Track;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SyncAllCommand extends Command
{
    protected $signature = 'f1:sync';

    protected $description = 'Sync all F1 data';

    public function handle()
    {
        Artisan::call('f1:drivers:sync');
        Artisan::call('f1:tracks:sync');
        Artisan::call('f1:seasons:sync');
        Artisan::call('f1:rounds:sync');
        Artisan::call('f1:drivers-per-season:sync');

        return Command::SUCCESS;
    }
}