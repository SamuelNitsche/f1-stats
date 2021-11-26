<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }

    public function qualifications()
    {
        return $this
            ->belongsToMany(Qualification::class)
            ->using(DriverQualification::class)
            ->withPivot([
                'position',
                'q1_time',
                'q2_time',
                'q3_time',
            ]);
    }

    public function races()
    {
        return $this
            ->belongsToMany(Race::class)
            ->using(DriverRace::class)
            ->withPivot([
                'position',
                'grid',
                'status',
                'laps',
                'points',
                'total_time_millis',
                'total_time',
                'fastest_lap_time',
                'fastest_lap_number',
                'fastest_lap_rank',
            ]);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function points($season = null)
    {
        if (! $season) {
            $season = Season::orderByDesc('year')->first();
        }

        return $this->races()->where('season_id', $season->id)->sum('points');
    }

    public function getLink()
    {
        return route('drivers.show', $this);
    }
}
