<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $primaryKey = 'year';

    public static function findByYear(string $year)
    {
        return static::where('year', $year)->firstOrFail();
    }

    public function races()
    {
        return $this->hasMany(Race::class, 'year', 'year')->orderBy('round');
    }

    public function getStandings()
    {
        $latestRaceOfSeason = $this
            ->races()
            ->whereHas('results')
            ->reorder('round', 'desc')
            ->first();

        if ($latestRaceOfSeason === null) {
            return [];
        }

        return DriverStandings::query()
            ->with(['driver', 'race'])
            ->where('raceId', $latestRaceOfSeason->raceId)
            ->orderBy('position')
            ->get();
    }

    public function getConstructorStandings()
    {
        $latestRaceOfSeason = $this
            ->races()
            ->whereHas('results')
            ->reorder('round', 'desc')
            ->first();

        if ($latestRaceOfSeason === null) {
            return [];
        }

        return ConstructorStandings::query()
            ->with(['constructor', 'race'])
            ->where('raceId', $latestRaceOfSeason->raceId)
            ->orderBy('position')
            ->get();
    }

    public function isOver(): bool
    {
        return $this->races->last()->date->isPast();
    }

    public function getDriverChampionshipWinner(): Driver
    {
        return $this->getStandings()->first()->driver;
    }

    public function getConstructorChampionshipWinner(): Constructor
    {
        return $this->getConstructorStandings()->first()->constructor;
    }
}
