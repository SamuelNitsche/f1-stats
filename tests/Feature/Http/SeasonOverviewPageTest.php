<?php

use App\Models\Season;
use function Pest\Laravel\get;

it('displays all seasons', function () {
    $seasons = Season::latest('year')->pluck('year')->toArray();

    get('/seasons')
        ->assertOk()
        ->assertSeeInOrder($seasons);
});
