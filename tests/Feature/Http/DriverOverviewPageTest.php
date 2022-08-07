<?php

it('displays all drivers', function () {
    $names = \App\Models\Driver::get(['forename', 'surname'])
        ->map(fn ($driver) => "{$driver->forename} {$driver->surname}")
        ->toArray();

    \Pest\Laravel\get('/drivers')
        ->assertSee($names);
});
