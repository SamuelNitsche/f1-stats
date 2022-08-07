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
            ->reorder('round', 'desc')
            ->first();

        return DriverStandings::query()
            ->with(['driver', 'race'])
            ->where('raceId', $latestRaceOfSeason->raceId)
            ->orderBy('position')
            ->get();
    }
}
