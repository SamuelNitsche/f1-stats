<?php

namespace App\Console\Commands;

use App\Models\Circuit;
use App\Models\Driver;
use App\Models\Round;
use App\Models\Season;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class SyncAllCommand extends Command
{
    protected $signature = 'f1:sync {year?}';

    protected $description = 'Sync all F1 data';

    public function handle()
    {
        $start = Carbon::parse(microtime(true));

        if (! $year = $this->argument('year')) {
            Artisan::call('f1:drivers:sync');
            Artisan::call('f1:tracks:sync');
            Artisan::call('f1:seasons:sync');
            Artisan::call('f1:drivers-per-season:sync');
            Artisan::call('f1:rounds:sync');
            Artisan::call('f1:qualifications:sync');
            Artisan::call('f1:races:sync');
        } else {
            Artisan::call('f1:rounds:sync', ['year' => $year]);
            Artisan::call('f1:qualifications:sync', ['year' => $year]);
            Artisan::call('f1:races:sync', ['year' => $year]);
        }

        $end = Carbon::parse(microtime(true));

        $this->info('Finished successfully after '.$start->longAbsoluteDiffForHumans($end));

        return self::SUCCESS;
    }
}
