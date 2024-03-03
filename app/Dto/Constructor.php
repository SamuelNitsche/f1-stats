<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Data;

class Constructor extends Data
{
    public function __construct(
        public string $constructorId,
        public string $url,
        public string $name,
        public string $nationality,
    ) {
    }
}
