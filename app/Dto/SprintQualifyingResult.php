<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class SprintQualifyingResult extends Data
{
    public function __construct(
        public ?int $number,
        public ?int $position,
        #[MapInputName('Driver')]
        public Driver $driver,
        #[MapInputName('Constructor')]
        public Constructor $constructor,
        public int $points,
        public int $laps,
        public int $grid,
        public string $status,
    ) {
    }
}
