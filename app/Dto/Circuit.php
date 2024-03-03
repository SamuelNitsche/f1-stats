<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class Circuit extends Data
{
    public function __construct(
        public string $circuitId,
        public string $url,
        public string $circuitName,
        #[MapInputName('Location')]
        public Location $location,
    ) {
    }
}
