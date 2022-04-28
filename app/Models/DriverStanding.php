<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverStanding extends Model
{
    use HasFactory;

    protected $table = 'driverStandings';

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverId', 'driverId');
    }
}
