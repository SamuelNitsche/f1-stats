<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\SprintQualifyingResult;

class SprintImporter implements DataImporter
{
    public const string orderBy = 'sprintResultId';

    public function import(array $data): void
    {
        $results = [];

        foreach ($data as $sprintResult) {
            $results[] = [
                'race_id' => $sprintResult['raceId'],
                'driver_id' => $sprintResult['driverId'],
                'constructor_id' => $sprintResult['constructorId'],
                'number' => $sprintResult['number'],
                'grid' => $sprintResult['grid'],
                'position' => $sprintResult['position'],
                'position_text' => $sprintResult['positionText'],
                'position_order' => $sprintResult['positionOrder'],
                'points' => $sprintResult['points'],
                'laps' => $sprintResult['laps'],
                'time' => $sprintResult['time'],
                'milliseconds' => $sprintResult['milliseconds'],
                'fastest_lap' => $sprintResult['fastestLap'],
                'fastest_lap_time' => $sprintResult['fastestLapTime'],
                'status_id' => $sprintResult['statusId'],
            ];
        }

        SprintQualifyingResult::insert($results);
    }
}
