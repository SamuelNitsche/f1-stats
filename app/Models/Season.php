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

    public function rounds()
    {
        return $this->hasMany(Round::class)->orderBy('round');
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function getChampionshipLeader()
    {
        return $this
            ->drivers()
            ->with('races')
            ->get()
            ->sortByDesc(function (Driver $driver) {
                return $driver
                    ->races()
                    ->where('season_id', $this->id)
                    ->sum('points');
            })
            ->first();
    }
}
