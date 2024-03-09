<?php

declare(strict_types=1);

namespace App\Dto;

use Spatie\LaravelData\Data;

class LapTime extends Data
{
    public function __construct(
        public int $lapNumber,
        public int $position,
        public string $time,
        public string $driverSlug,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            lapNumber: $data['number'],
            position: $data['Timings'][0]['position'],
            time: $data['Timings'][0]['time'],
            driverSlug: $data['Timings'][0]['driverId'],
        );
    }
}
