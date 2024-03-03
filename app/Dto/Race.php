<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class Race extends Data
{
    #[Computed]
    public ?Carbon $dateTime;

    public function __construct(
        public string $season,
        public string $round,
        public string $url,
        public string $raceName,
        #[MapInputName('Circuit')]
        public Circuit $circuit,
        public ?string $date,
        public ?string $time,
        #[MapInputName('FirstPractice')]
        public ?SessionInfo $firstPractice,
        #[MapInputName('SecondPractice')]
        public ?SessionInfo $secondPractice,
        #[MapInputName('ThirdPractice')]
        public ?SessionInfo $thirdPractice,
        #[MapInputName('Qualifying')]
        public ?SessionInfo $qualifying,
        #[MapInputName('Sprint')]
        public ?SessionInfo $sprint,
    ) {
        $this->dateTime = ($date && $time) ? Carbon::parse("{$date} {$time}") : null;
    }
}
