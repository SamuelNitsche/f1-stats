<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Driver;
use App\Dto\LapTime;
use App\Dto\QualifyingResult;
use App\Dto\Race;
use App\Dto\RaceResult;
use App\Dto\Season;

interface FormulaOneService
{
    /**
     * @return Season[]
     */
    public function getSeasons(): array;

    /**
     * @return Race[]
     */
    public function getRacesPerSeason(Season $season): array;

    /**
     * @return RaceResult[]
     */
    public function getRaceResults(Race $race): array;

    /**
     * @return QualifyingResult[]
     */
    public function getQualifyingResults(Race $race): array;

    /**
     * @return Driver[]
     */
    public function getDriversAttendedRace(Race $race): array;

    /**
     * @return LapTime[]
     */
    public function getLapTimesForDriverAndRace(Driver $driver, Race $race): array;
}
