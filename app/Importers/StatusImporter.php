<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\Status;

class StatusImporter implements DataImporter
{
    public const string orderBy = 'statusId';

    public function import(array $data): void
    {
        $results = [];

        foreach ($data as $status) {
            $results[] = [
                'id' => $status['statusId'],
                'text' => $status['status'],
            ];
        }

        Status::insert($results);
    }
}
