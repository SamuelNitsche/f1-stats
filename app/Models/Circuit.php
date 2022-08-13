<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    protected $primaryKey = 'circuitId';

    public function hasImage(): bool
    {
        return File::exists("images/circuits/{$this->circuitRef}.png");
    }

    public function getImageUrl(): string
    {
        return asset("images/circuits/{$this->circuitRef}.png");
    }
}
