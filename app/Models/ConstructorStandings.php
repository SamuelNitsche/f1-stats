<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructorStandings extends Model
{
    protected $primaryKey = 'constructorStandingsId';

    protected $table = 'constructorStandings';

    public function constructor()
    {
        return $this->belongsTo(Constructor::class, 'constructorId', 'constructorId');
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
