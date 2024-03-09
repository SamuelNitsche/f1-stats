<?php

declare(strict_types=1);

namespace App\Importers;

use App\Models\Circuit;
use App\Models\Race;
use App\Models\Season;
use Illuminate\Support\Collection;

class RaceImporter implements DataImporter
{
    public const string orderBy = 'raceId';

    public function import(array $data): void
    {
        $races = [];

        foreach ($data as $race) {
            $races[] = [
                'id' => $race['raceId'],
                'season_id' => Season::where('year', $race['year'])->firstOrFail()->id,
                'circuit_id' => Circuit::where('id', $race['circuitId'])->firstOrFail()->id,
                'round' => $race['round'],
                'name' => $race['name'],
                'starts_at' => $this->getDateTime(data: $race, dateKey: 'date', timeKey: 'time'),
                'fp1_starts_at' => $this->getDateTime(data: $race, sessionName: 'fp1'),
                'fp2_starts_at' => $this->getDateTime(data: $race, sessionName: 'fp2'),
                'fp3_starts_at' => $this->getDateTime(data: $race, sessionName: 'fp3'),
                'qualifying_starts_at' => $this->getDateTime(data: $race, sessionName: 'quali'),
                'sprint_starts_at' => $this->getDateTime(data: $race, sessionName: 'sprint'),
                'url' => $race['url'],
            ];
        }

        Race::insert($races);
    }

    private function getDateTime(
        array $data,
        ?string $sessionName = null,
        ?string $dateKey = null,
        ?string $timeKey = null
    ): ?string {
        $dateKey ??= sprintf('%s_date', $sessionName);
        $timeKey ??= sprintf('%s_time', $sessionName);

        if ($data[$dateKey] === null || $data[$timeKey] === null) {
            return null;
        }

        return sprintf('%s %s', $data[$dateKey], $data[$timeKey]);
    }
}
