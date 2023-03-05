<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Constructor extends Model
{
    use HasRelationships;

    protected $primaryKey = 'constructorId';

    public function getForeignKey()
    {
        return 'constructorId';
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
}
