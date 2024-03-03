<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Data;

class Season extends Data
{
    public function __construct(
        public string $year,
        public string $url,
    ) {
    }
}
