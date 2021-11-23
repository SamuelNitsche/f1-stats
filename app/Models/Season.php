<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'season',
        'wikipedia_url',
    ];

    public function rounds()
    {
        return $this->hasMany(Round::class)->orderBy('round');
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function getStandings()
    {
        return Cache::remember("standings-{$this->year}", now()->addMinutes(10), function () {
            return $this
                ->drivers()
                ->with('races')
                ->get()
                ->sortByDesc(function (Driver $driver) {
                    return $driver->points($this);
                });
        });
    }
}
