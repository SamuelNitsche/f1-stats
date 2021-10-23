<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }

    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class)->using(DriverQualification::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
