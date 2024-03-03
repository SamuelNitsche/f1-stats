<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Data;

class Location extends Data
{
    public function __construct(
        public string $lat,
        public string $long,
        public string $locality,
        public string $country,
    ) {
    }
}
