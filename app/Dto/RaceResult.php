<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class RaceResult extends Data
{
    public function __construct(
        public ?int $number,
        public ?int $position,
        public int $points,
        #[MapInputName('Driver')]
        public Driver $driver,
        #[MapInputName('Constructor')]
        public Constructor $constructor,
        public int $grid,
        public int $laps,
        public string $status,
    ) {
    }
}
