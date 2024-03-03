<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    public function circuit(): HasOne
    {
        return $this->hasOne(Circuit::class);
    }
}
