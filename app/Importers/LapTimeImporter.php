<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\Driver;
use App\Models\LapTime;
use App\Models\Race;
use Illuminate\Support\Collection;

class LapTimeImporter implements DataImporter
{
    public const string orderBy = 'driverId';

    public function import(array $data): void
    {
        $objects = [];

        foreach ($data as $lapTime) {
            $objects[] = [
                'race_id' => $lapTime['raceId'],
                'driver_id' => $lapTime['driverId'],
                'lap_number' => $lapTime['lap'],
                'position' => $lapTime['position'],
                'time' => $lapTime['time'],
            ];
        }

        LapTime::insert($objects);
    }
}
