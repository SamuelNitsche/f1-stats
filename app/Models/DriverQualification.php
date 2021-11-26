<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverQualification extends Pivot
{
    public function scopeForTrack(Builder $query, Track $track)
    {
        return $query->where('track_id', $track->id);
    }
}
