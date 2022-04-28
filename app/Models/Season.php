<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'season',
        'wikipedia_url',
    ];

    public function races()
    {
        return $this->hasMany(Race::class, 'year', 'year')->orderBy('round');
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function getStandings()
    {
        return DriverStanding::query()
            ->with('driver')
            ->where('raceId', $this->races->last()->raceId)
            ->orderByDesc('points')
            ->get();
    }

    public function hasEnded()
    {
        $this->races->each(function (Race $race) {
            if (! $race->winner) {
                return false;
            }
        });

        return true;
    }
}
