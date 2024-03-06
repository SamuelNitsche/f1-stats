<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Dto\Race;
use App\Models\Circuit;
use App\Models\Constructor;
use App\Models\Driver;
use App\Models\Location;
use App\Models\QualifyingResult;
use App\Models\RaceResult;
use App\Models\Season;
use App\Models\Status;
use App\Services\FormulaOneService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'sync-f1-stats';

    protected $description = 'Sync the F1 stats with the API.';

    public function __construct(
        protected FormulaOneService $formulaOne
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $seasons = $this->formulaOne->getSeasons();

        foreach ($seasons as $season) {
            if ($season->year >= 2019) {
                $dbSeason = $this->ensureSeason($season);

                $races = $this->formulaOne->getRacesPerSeason($season);
                foreach ($races as $race) {
                    // Create or update the location
                    $dbLocation = $this->ensureLocation($race);

                    // Create or update the circuit
                    $dbCircuit = $this->ensureCircuit($race, $dbLocation);

                    // Create or update the race
                    $dbRace = $this->ensureRace($dbSeason, $race, $dbCircuit);

                    if ($dbRace->isSprintRace()) {
                        $this->ensureSprintQualifyingResults($race, $dbRace->id);
                    }

                    // Create or update all qualifying results
                    $this->ensureQualifyingResults($race, $dbRace->id);

                    // Create or update all results of the race
                    $this->ensureRaceResults($race, $dbRace->id);
                }
            }
        }
    }

    public function ensureSeason(\App\Dto\Season $season): Season
    {
        $dbSeason = Season::updateOrCreate([
            'year' => $season->year,
        ], [
            'url' => $season->url,
        ]);

        return $dbSeason;
    }

    public function ensureLocation(Race $race): Location
    {
        $dbLocation = Location::updateOrCreate([
            'lat' => $race->circuit->location->lat,
            'long' => $race->circuit->location->long,
            'locality' => $race->circuit->location->locality,
            'country' => $race->circuit->location->country,
        ]);

        return $dbLocation;
    }

    public function ensureCircuit(Race $race, Location $dbLocation): Circuit
    {
        $dbCircuit = Circuit::updateOrCreate([
            'slug' => $race->circuit->circuitId,
        ], [
            'location_id' => $dbLocation->id,
            'name' => $race->circuit->circuitName,
            'url' => $race->circuit->url,
        ]);

        return $dbCircuit;
    }

    public function ensureRace(Season $dbSeason, Race $race, Circuit $dbCircuit): \App\Models\Race|\Illuminate\Database\Eloquent\Model
    {
        $dbRace = $dbSeason->races()->updateOrCreate([
            'season_id' => $dbSeason->id,
            'round' => $race->round,
        ], [
            'circuit_id' => $dbCircuit->id,
            'name' => $race->raceName,
            'url' => $race->url,
            'starts_at' => $race->dateTime,
            'fp1_starts_at' => $race->firstPractice?->dateTime,
            'fp2_starts_at' => $race->secondPractice?->dateTime,
            'fp3_starts_at' => $race->thirdPractice?->dateTime,
            'qualifying_starts_at' => $race->qualifying?->dateTime,
            'sprint_starts_at' => $race->sprint?->dateTime,
        ]);

        return $dbRace;
    }

    public function ensureRaceResults(Race $race, int $databaseRaceId): void
    {
        $results = $this->formulaOne->getRaceResults($race);

        foreach ($results as $result) {
            // Create or update the driver
            $dbDriver = $this->ensureDriver($result->driver);

            // Create or update the constructor
            $dbConstructor = $this->ensureConstructor($result->constructor);

            // Create or update the status
            $dbStatus = $this->ensureStatus($result->status);

            RaceResult::updateOrCreate([
                'race_id' => $databaseRaceId,
                'driver_id' => $dbDriver->id,
            ], [
                'driver_id' => $dbDriver->id,
                'constructor_id' => $dbConstructor->id,
                'status_id' => $dbStatus->id,
                'number' => $result->number,
                'position' => $result->position,
                'points' => $result->points,
                'grid' => $result->grid,
                'laps' => $result->laps,
            ]);
        }
    }

    protected function ensureQualifyingResults(Race $race, int $databaseRaceId): void
    {
        $results = $this->formulaOne->getQualifyingResults($race);

        foreach ($results as $result) {
            // Create or update the driver
            $dbDriver = $this->ensureDriver($result->driver);

            // Create or update the constructor
            $dbConstructor = $this->ensureConstructor($result->constructor);

            QualifyingResult::updateOrCreate([
                'race_id' => $databaseRaceId,
                'driver_id' => $dbDriver->id,
            ], [
                'driver_id' => $dbDriver->id,
                'constructor_id' => $dbConstructor->id,
                'number' => $result->number,
                'position' => $result->position,
                'q1' => $result->q1,
                'q2' => $result->q2,
                'q3' => $result->q3,
            ]);
        }
    }

    protected function ensureSprintQualifyingResults(Race $race, int $databaseRaceId): void
    {
        $results = $this->formulaOne->getSprintQualifyingResults($race);

        dd($results);

        foreach ($results as $result) {
            // Create or update the driver
            $dbDriver = $this->ensureDriver($result->driver);

            // Create or update the constructor
            $dbConstructor = $this->ensureConstructor($result->constructor);

            QualifyingResult::updateOrCreate([
            ], []);
        }
    }

    protected function ensureDriver(\App\Dto\Driver $driver): Driver
    {
        return Driver::updateOrCreate([
            'slug' => $driver->driverId,
        ], [
            'url' => $driver->url,
            'given_name' => $driver->givenName,
            'family_name' => $driver->familyName,
            'date_of_birth' => $driver->dateOfBirth,
        ]);
    }

    protected function ensureConstructor(\App\Dto\Constructor $constructor): Constructor
    {
        return Constructor::updateOrCreate([
            'slug' => $constructor->constructorId,
        ], [
            'url' => $constructor->url,
            'name' => $constructor->name,
            'nationality' => $constructor->nationality,
        ]);
    }

    protected function ensureStatus(string $status): Status
    {
        return Status::updateOrCreate([
            'text' => $status,
        ]);
    }
}
