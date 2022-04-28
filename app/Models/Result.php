<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverId', 'driverId');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'statusId', 'statusId');
    }
}
