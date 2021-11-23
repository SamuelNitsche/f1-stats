<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverRace extends Pivot
{
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function hasChangedPosition()
    {
        return $this->hasGainedPositions() || $this->hasLostPositions();
    }

    public function hasLostPositions()
    {
        return $this->position > $this->grid;
    }

    public function hasGainedPositions()
    {
        return $this->position < $this->grid;
    }

    public function getPositionDiff()
    {
        return abs($this->position - $this->grid);
    }

    protected function getPositionDiffSymbol()
    {
        if ($this->hasLostPositions()) {
            return '▼';
        } elseif ($this->hasGainedPositions()) {
            return '▲';
        } else {
            return '';
        }
    }
}
