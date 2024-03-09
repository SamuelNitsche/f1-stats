<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\QualifyingResult;

class QualifyingImporter implements DataImporter
{
    public const string orderBy = 'raceId';

    public function import(array $data): void
    {
        $qualifyingResults = [];

        foreach ($data as $qualifyingResult) {
            $qualifyingResults[] = [
                'id' => $qualifyingResult['qualifyId'],
                'race_id' => $qualifyingResult['raceId'],
                'driver_id' => $qualifyingResult['driverId'],
                'constructor_id' => $qualifyingResult['constructorId'],
                'number' => $qualifyingResult['number'],
                'position' => $qualifyingResult['position'],
                'q1' => $qualifyingResult['q1'],
                'q2' => $qualifyingResult['q2'],
                'q3' => $qualifyingResult['q3'],
            ];
        }

        QualifyingResult::insert($qualifyingResults);
    }
}
