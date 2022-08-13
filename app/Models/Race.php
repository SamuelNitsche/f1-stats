<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $primaryKey = 'raceId';

    public function circuit()
    {
        return $this->belongsTo(Circuit::class, 'circuitId', 'circuitId');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'year', 'year');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'raceId', 'raceId')
            ->orderByRaw('ISNULL(position), position ASC');
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class, 'raceId', 'raceId')
            ->orderByRaw('ISNULL(position), position ASC');
    }

    public function scopeUpcoming(Builder $query)
    {
        return $this
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');
    }

    public function scopePrevious(Builder $query)
    {
        return $this
            ->where('date', '<', now())
            ->orderBy('date', 'desc');
    }

    public function getDate()
    {
        return new Carbon("{$this->date->format('Y-m-d')} {$this->time}", 'UTC');
    }

    public function getNextSessionDate()
    {
        $foo = collect($this->only([
            'fp1_date',
            'fp1_time',
            'fp2_date',
            'fp2_time',
            'fp3_date',
            'fp3_time',
            'quali_date',
            'quali_time',
            'sprint_date',
            'sprint_time',
            'date',
            'time',
        ]))->values();

        $times = [
            'fp1' => "$foo[0] $foo[1]",
            'fp2' => "$foo[2] $foo[3]",
            'fp3' => "$foo[4] $foo[5]",
            'quali' => "$foo[6] $foo[7]",
            'sprint' => "$foo[8] $foo[9]",
            'race' => "$foo[10] $foo[11]",
        ];

        $next = collect($times)
            ->filter(fn ($time) => !empty(trim($time)))
            ->sort()
            ->first();

        return new Carbon($next);
    }
}
