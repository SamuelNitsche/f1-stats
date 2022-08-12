<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Driver extends Model
{
    use HasRelationships;

    protected $primaryKey = 'driverId';

    public function getForeignKey()
    {
        return 'driverId';
    }

    public function seasons()
    {
        return $this->hasManyDeepFromRelations(
            $this->races(),
            (new Race())->season(),
        )
            ->orderByDesc('seasons.year')
            ->distinct();
    }

    public function results()
    {
        return $this
            ->hasMany(Result::class)
            ->orderBy('raceId', 'desc');
    }

    public function races()
    {
        return $this->hasManyDeepFromRelations(
            $this->results(),
            (new Result())->race()
        )
            ->orderBy('round');
    }

    public function qualifications()
    {
        return $this
            ->hasMany(Qualification::class)
            ->orderByDesc('raceId');
    }

    public function getFullNameAttribute()
    {
        return "{$this->forename} {$this->surname}";
    }
}
