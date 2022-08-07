<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public function races()
    {
        return $this->hasMany(Race::class, 'year', 'year')->orderBy('round');
    }
}
