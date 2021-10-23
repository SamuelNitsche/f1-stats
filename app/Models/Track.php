<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
