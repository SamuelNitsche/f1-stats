<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

class Result extends Model
{
    use HasFactory;
    use HasRelationships;
    use BelongsToThrough;

    protected $primaryKey = 'resultId';

    public function getForeignKey()
    {
        return 'resultId';
    }

    public function race()
    {
        return $this->belongsTo(Race::class, 'raceId', 'raceId');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverId', 'driverId');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'statusId', 'statusId');
    }

    public function season()
    {
        return $this->belongsToThrough(
            Season::class,
            Race::class,
            null,
            '',
            [
                Race::class => 'raceId',
                Season::class => 'year',
            ]
        );
    }
}
