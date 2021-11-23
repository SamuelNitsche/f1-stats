<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'round_id',
        'track_id',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class)
            ->using(DriverRace::class)
            ->orderBy('position')
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

    public function winner()
    {
        return $this->hasOne(DriverRace::class)->where('position', 1);
    }

    public function fastestLap()
    {
        return $this->hasOne(DriverRace::class)
            ->whereNotNull('fastest_lap_time')
            ->orderByRaw('TIME_TO_SEC(fastest_lap_time)');
    }
}
