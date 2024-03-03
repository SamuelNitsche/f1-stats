<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Data;

class Driver extends Data
{
    public function __construct(
        public string $driverId,
        public string $url,
        public string $givenName,
        public string $familyName,
        public string $dateOfBirth,
        public string $nationality,
    ) {
    }
}
