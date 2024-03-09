<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\RaceResult;

class ResultImporter implements DataImporter
{
    public const string orderBy = 'resultId';

    public function import(array $data): void
    {
        $results = [];

        foreach ($data as $result) {
            $results[] = [
                'id' => $result['resultId'],
                'race_id' => $result['raceId'],
                'status_id' => $result['statusId'],
                'driver_id' => $result['driverId'],
                'constructor_id' => $result['constructorId'],
                'number' => $result['number'],
                'position' => $result['position'],
                'points' => $result['points'],
                'grid' => $result['grid'],
                'laps' => $result['laps'],
                //                'position_text' => $result->positionText,
                //                'position_order' => $result->positionOrder,
                //                'time' => $result->time,
                //                'milliseconds' => $result->milliseconds,
                //                'fastest_lap' => $result->fastestLap,
                //                'rank' => $result->rank,
                //                'fastest_lap_time' => $result->fastestLapTime,
                //                'fastest_lap_speed' => $result->fastestLapSpeed,
            ];
        }

        RaceResult::insert($results);
    }
}
