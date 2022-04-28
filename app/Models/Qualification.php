<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'round_id',
        'track_id',
    ];

    public function drivers()
    {
        return $this->belongsToMany(Driver::class)
            ->using(DriverQualification::class)
            ->orderBy('position')
            ->withPivot([
                'position',
                'q1_time',
                'q2_time',
                'q3_time',
            ]);
    }

    public function track()
    {
        return $this->belongsTo(Circuit::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
