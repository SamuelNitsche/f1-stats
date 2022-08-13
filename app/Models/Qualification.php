<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Qualification extends Model
{
    use BelongsToThrough;

    protected $table = 'qualifying';

    protected $primaryKey = 'qualifyId';

    public function race()
    {
        return $this->belongsTo(Race::class, 'raceId');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverId');
    }

    public function season()
    {
        return $this->belongsToThrough(Season::class, Race::class, null, '', [
            Season::class => 'year',
            Race::class => 'raceId',
        ]);
    }

    public function circuit()
    {
        return $this->belongsToThrough(Circuit::class, Race::class, null, '', [
            Circuit::class => 'circuitId',
            Race::class => 'raceId',
        ]);
    }
}
