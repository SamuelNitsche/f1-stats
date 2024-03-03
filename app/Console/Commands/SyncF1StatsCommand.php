<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\FormulaOneService;
use DB;
use Illuminate\Console\Command;
use Storage;

class SyncF1StatsCommand extends Command
{
    protected $signature = 'sync-f1-stats';

    protected $description = 'Download the latest database from the ergast api and import the data';

    protected FormulaOneService $service;

    public function __construct(FormulaOneService $formulaOneService)
    {
        parent::__construct();

        $this->service = $formulaOneService;
    }

    public function handle(): void
    {
        if (! $this->service->getDatabase()) {
            $this->error('Unable to download file');
        }

        $this->extractDatabase();

        $this->importDatabase();

        $this->deleteDatabaseFile();
    }

    protected function importDatabase(): void
    {
        DB::unprepared(
            file_get_contents(
                storage_path('app/f1-database.sql')
            )
        );
    }

    protected function extractDatabase(): void
    {
        exec('gunzip '.storage_path('app/f1-database.sql.gz'));
    }

    protected function deleteDatabaseFile(): void
    {
        Storage::delete('f1-database.sql');
    }
}
