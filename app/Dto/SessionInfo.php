<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class SessionInfo extends Data
{
    #[Computed]
    public ?Carbon $dateTime;

    public function __construct(
        public ?string $date,
        public ?string $time,
    ) {
        $this->dateTime = ($date && $time) ? Carbon::parse("{$date} {$time}") : null;
    }
}
