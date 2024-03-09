<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\Constructor;

class ConstructorImporter implements DataImporter
{
    public const string orderBy = 'constructorId';

    public function import(array $data): void
    {
        foreach ($data as $constructor) {
            Constructor::create([
                'id' => $constructor['constructorId'],
                'slug' => $constructor['constructorRef'],
                'name' => $constructor['name'],
                'nationality' => $constructor['nationality'],
                'url' => $constructor['url'],
            ]);
        }
    }
}
