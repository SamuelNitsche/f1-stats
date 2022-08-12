<?php

namespace App\Console\Commands;

use App\Services\FormulaOneService;
use Illuminate\Console\Command;

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

    public function handle()
    {
        if (! $this->service->getDatabase()) {
            $this->error('Unable to download file');
        }

        $this->extractDatabase();

        $this->importDatabase();

        $this->deleteDatabaseFile();
    }

    protected function importDatabase()
    {
        \DB::unprepared(
            file_get_contents(
                storage_path('app/f1-database.sql')
            )
        );
    }

    protected function extractDatabase()
    {
        exec('gunzip '.storage_path('app/f1-database.sql.gz'));
    }

    protected function deleteDatabaseFile()
    {
        \Storage::delete('f1-database.sql');
    }
}
