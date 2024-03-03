<?php

declare(strict_types=1);

use App\Models\Season;

use function Pest\Laravel\get;

it('redirects to the latest version', function (): void {
    $year = Season::latest('year')->first()->year;

    get('/seasons')
        ->assertRedirect("/seasons/{$year}");
});
