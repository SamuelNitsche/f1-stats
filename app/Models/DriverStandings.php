<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverStandings extends Model
{
    protected $primaryKey = 'driverStandingsId';

    protected $table = 'driverStandings';

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverId', 'driverId');
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
