<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class QualifyingResult extends Data
{
    public function __construct(
        public ?int $number,
        public ?int $position,
        #[MapInputName('Driver')]
        public Driver $driver,
        #[MapInputName('Constructor')]
        public Constructor $constructor,
        #[MapInputName('Q1')]
        public ?string $q1,
        #[MapInputName('Q2')]
        public ?string $q2,
        #[MapInputName('Q3')]
        public ?string $q3,
    ) {
    }
}
