<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\Driver;

class DriverImporter implements DataImporter
{
    public const string orderBy = 'driverId';

    public function import(array $data): void
    {
        foreach ($data as $driver) {
            Driver::create([
                'id' => $driver['driverId'],
                'slug' => $driver['driverRef'],
                'url' => $driver['url'],
                'given_name' => $driver['forename'],
                'family_name' => $driver['surname'],
                'date_of_birth' => $driver['dob'],
            ]);
        }
    }
}
