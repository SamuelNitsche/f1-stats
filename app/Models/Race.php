<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        return $this->belongsTo(Season::class, 'year', 'year');
    }

    public function circuit()
    {
        return $this->belongsTo(Circuit::class, 'circuitId', 'circuitId');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'raceId', 'raceId')
            ->orderByRaw('ISNULL(position), position ASC');
    }

    public function standings()
    {
        return $this->hasMany(DriverStanding::class, 'raceId', 'raceId')
            ->orderBy('position');
    }

    public function scopePrevious(Builder $query)
    {
        return $query
            ->where('date', '<=', now())
            ->orderByDesc('date');
    }

    public function scopeUpcoming(Builder $query)
    {
        return $query
            ->where('date', '>=', now())
            ->orderBy('date');
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
