<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Importers\CircuitImporter;
use App\Importers\ConstructorImporter;
use App\Importers\DriverImporter;
use App\Importers\LapTimeImporter;
use App\Importers\QualifyingImporter;
use App\Importers\RaceImporter;
use App\Importers\ResultImporter;
use App\Importers\SeasonImporter;
use App\Importers\SprintImporter;
use App\Importers\StatusImporter;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportDatabaseFileCommand extends Command
{
    protected $signature = 'import:database-file';

    protected $description = 'Bulk import data from a database file';

    public function handle(): void
    {
        //        $confirm = $this->confirm('This command will overwrite the current database. Do you want to continue?');
        //
        //        if (!$confirm) {
        //            $this->info('Aborting...');
        //            return;
        //        }

        // Drop the current database
        $this->info('Dropping the current database...');
        Artisan::call('migrate:fresh');

        // Create a new connection to the temporary database
        config(['database.connections.mysql_temp' => config('database.connections.mysql')]);
        config(['database.connections.mysql_temp.database' => 'f1db_temp']);

        //        // Make sure the database file exists
        //        $this->info('Checking if the database file exists...');
        //        $this->databaseFileExists();
        //
        //        // Create a temporary database to import the data into
        //        $this->info('Creating a temporary database...');
        //        $this->createTemporaryDatabase();
        //
        //        // Import the data from the database file
        //        $this->info('Importing the data from the database file...');
        //        $this->importData();

        // Import data from temporary database to the main database
        $this->info('Importing the data from the temporary database to the main database...');
        $this->importDataToMainDatabase();
    }

    /**
     * @throws Exception
     */
    private function databaseFileExists(): void
    {
        if ( ! Storage::exists('f1db.sql')) {
            throw new Exception('The database file does not exist.');
        }
    }

    /**
     * @throws Exception
     */
    private function createTemporaryDatabase(): void
    {
        $successful = DB::statement('DROP DATABASE f1db_temp');
        if ( ! $successful) {
            throw new Exception('Could not drop the temporary database.');
        }

        $successful = DB::statement('CREATE DATABASE f1db_temp');
        if ( ! $successful) {
            throw new Exception('Could not create the temporary database.');
        }
    }

    private function importData(): void
    {
        $path = storage_path('app/f1db.sql');

        $command = sprintf(
            'mysql -u%s -p%s %s < %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            'f1db_temp',
            $path
        );

        exec($command);
    }

    private function importDataToMainDatabase(): void
    {
        $tables = [
            'circuits' => CircuitImporter::class,
            'status' => StatusImporter::class,
            'constructors' => ConstructorImporter::class,
            'constructorResults' => null,
            'constructorStandings' => null,
            'driverStandings' => null,
            'drivers' => DriverImporter::class,
            'seasons' => SeasonImporter::class,
            'races' => RaceImporter::class,
            'lapTimes' => LapTimeImporter::class,
            'pitStops' => null,
            'qualifying' => QualifyingImporter::class,
            'results' => ResultImporter::class,
            'sprintResults' => SprintImporter::class,
        ];

        foreach ($tables as $table => $importClass) {
            if ($importClass === null) {
                $this->info(sprintf('Skipping table: %s, no importer found.', $table));

                continue;
            }

            $this->info("Importing table: {$table}");
            $this->importTable($table, $importClass);
        }
    }

    private function importTable(string $table, string $importClass): void
    {
        // Create a progress bar
        $count = DB::connection('mysql_temp')->table($table)->count();
        $bar = $this->output->createProgressBar($count);

        // Get the data from the temporary database using a generator
        DB::connection('mysql_temp')
            ->table($table)
            ->orderBy($importClass::orderBy)
            ->chunk(5_000, function ($data) use ($importClass, $bar): void {
                $importer = new $importClass();
                $importer->import($data->map(fn ($item) => (array) $item)->toArray());
                $bar->advance($data->count());
                $this->newLine();
            });

        $bar->finish();
    }
}
