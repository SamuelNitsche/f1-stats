<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Driver;
use App\Dto\LapTime;
use App\Dto\QualifyingResult;
use App\Dto\Race;
use App\Dto\RaceResult;
use App\Dto\Season;
use App\Dto\SprintQualifyingResult;
use App\Http\Integrations\Ergast\ErgastConnector;
use App\Http\Integrations\Ergast\Requests\GetDriversByRaceRequest;
use App\Http\Integrations\Ergast\Requests\GetLapTimesForDriverAndRaceRequest;
use App\Http\Integrations\Ergast\Requests\GetQualifyingResultsRequest;
use App\Http\Integrations\Ergast\Requests\GetRaceResultsRequest;
use App\Http\Integrations\Ergast\Requests\GetRacesPerSeasonRequest;
use App\Http\Integrations\Ergast\Requests\GetSeasonsRequest;
use App\Http\Integrations\Ergast\Requests\GetSprintQualifyingResultsRequest;

class ErgastService implements FormulaOneService
{
    private ErgastConnector $connector;

    public function __construct()
    {
        $this->connector = new ErgastConnector();
    }

    /**
     * @return Season[]
     */
    public function getSeasons(): array
    {
        $seasons = [];

        $request = new GetSeasonsRequest();
        $paginator = $request->paginate($this->connector);
        foreach ($paginator->items() as $season) {
            $seasons[] = new Season($season['season'], $season['url']);
        }

        return $seasons;
    }

    /**
     * @return Season[]
     */
    public function getRacesPerSeason(Season $season): array
    {
        $races = [];

        $request = new GetRacesPerSeasonRequest($season->year);
        $paginator = $request->paginate($this->connector);
        foreach ($paginator->items() as $race) {
            $races[] = Race::from($race);
        }

        return $races;
    }

    /**
     * @return RaceResult[]
     */
    public function getRaceResults(Race $race): array
    {
        $results = [];

        $request = new GetRaceResultsRequest($race->season, $race->round);
        $paginator = $request->paginate($this->connector);
        foreach ($paginator->items() as $result) {
            foreach ($result['Results'] as $driverResult) {
                $results[] = RaceResult::from($driverResult);
            }
        }

        return $results;
    }

    /**
     * @return QualifyingResult[]
     */
    public function getQualifyingResults(Race $race): array
    {
        $results = [];

        $request = new GetQualifyingResultsRequest($race->season, $race->round);
        $paginator = $request->paginate($this->connector);
        foreach ($paginator->items() as $result) {
            foreach ($result['QualifyingResults'] as $driverResult) {
                $results[] = QualifyingResult::from($driverResult);
            }
        }

        return $results;
    }

    /**
     * @return SprintQualifyingResult[]
     */
    public function getSprintQualifyingResults(Race $race): array
    {
        $results = [];

        $request = new GetSprintQualifyingResultsRequest($race->season, $race->round);
        $paginator = $request->paginate($this->connector);
        foreach ($paginator->items() as $result) {
            foreach ($result['SprintResults'] as $driverResult) {
                $results[] = SprintQualifyingResult::from($driverResult);
            }
        }

        return $results;
    }

    /**
     * @return Driver[]
     */
    public function getDriversAttendedRace(Race $race): array
    {
        $results = [];

        $request = new GetDriversByRaceRequest($race->season, $race->round);
        $paginator = $request->paginate($this->connector);
        foreach ($paginator->items() as $driver) {
            $results[] = Driver::from($driver);
        }

        return $results;
    }

    /**
     * @return LapTime[]
     */
    public function getLapTimesForDriverAndRace(Driver $driver, Race $race): array
    {
        $results = [];

        $request = new GetLapTimesForDriverAndRaceRequest($race->season, $race->round, $driver->driverId);
        $paginator = $request->paginate($this->connector);
        foreach ($paginator->items() as $lapTime) {
            foreach ($lapTime['Laps'] as $lap) {
                $results[] = LapTime::from($lap);
            }
        }

        return $results;
    }
}
