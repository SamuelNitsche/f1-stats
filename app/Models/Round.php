<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $dates = [
        'date',
    ];

    public function scopeUpcoming(Builder $query)
    {
        return $query
            ->where('date', '>=', now())
            ->orderBy('date');
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function qualification()
    {
        return $this->hasOne(Qualification::class);
    }

    public function race()
    {
        return $this->hasOne(Race::class);
    }
}
