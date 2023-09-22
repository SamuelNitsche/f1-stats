<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Race extends Model
{
    use HasFactory;

    protected $primaryKey = 'raceId';

    protected $casts = [
        'fp1_date' => 'date:Y-m-d',
        'fp2_date' => 'date:Y-m-d',
        'fp3_date' => 'date:Y-m-d',
        'quali_date' => 'date:Y-m-d',
        'sprint_date' => 'date:Y-m-d',
        'date' => 'date:Y-m-d',
    ];

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
            ->where('date', '>=', now()->startOfDay())
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

    public function isOver()
    {
        return $this->getDate()->isPast();
    }

    public function getNextSessionDate()
    {
        return collect($this->only([
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
        ]))
            ->chunk(2)
            ->map(function (Collection $entry) {
                return "{$entry->first()?->toDateString()} {$entry->last()}";
            })
            ->filter(fn ($entry) => ! empty(trim($entry)))
            ->sort()
            ->map(fn ($entry) => new Carbon($entry))
            ->firstWhere(fn (Carbon $entry) => $entry->gte(now()));
    }
}
