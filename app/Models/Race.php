<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $primaryKey = 'raceId';

    protected $casts = [
        'date' => 'date'
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
}
