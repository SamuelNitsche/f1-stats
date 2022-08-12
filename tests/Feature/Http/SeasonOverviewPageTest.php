<?php

use App\Models\Season;
use function Pest\Laravel\get;

it('redirects to the latest version', function () {
    $year = Season::latest('year')->first()->year;

    get('/seasons')
        ->assertRedirect("/seasons/{$year}");
});
