<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\Season;
use Illuminate\Support\Collection;

class SeasonImporter implements DataImporter
{
    public const string orderBy = 'year';

    public function import(array $data): void
    {
        foreach ($data as $season) {
            Season::create([
                'year' => $season['year'],
                'url' => $season['url'],
            ]);
        }
    }
}
