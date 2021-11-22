<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverRace extends Pivot
{
    public function getPositionsGainedOrLost()
    {
        return $this->getDiffSign($this->position, $this->grid);
    }

    protected function getDiffSign($a, $b)
    {
        if ($a > $b) {
            return '+' . $this->getDiff($a, $b);
        } elseif ($a < $b) {
            return '-' . $this->getDiff($a, $b);
        } else {
            return '±' . $this->getDiff($a, $b);
        }
    }

    protected function getDiff($a, $b)
    {
        return abs($a - $b);
    }
}
