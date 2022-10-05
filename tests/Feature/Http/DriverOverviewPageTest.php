<?php

it('displays all drivers by first letter of surname', function () {
    $names = \App\Models\Driver::query()
        ->where('surname', 'like', 'A%')
        ->get(['forename', 'surname'])
        ->map(fn ($driver) => "{$driver->forename} {$driver->surname}")
        ->toArray();

    \Pest\Laravel\get('/drivers')
        ->assertSee($names);
});

it('letter can be filtered in url', function () {
    $names = \App\Models\Driver::query()
        ->where('surname', 'like', 'F%')
        ->get(['forename', 'surname'])
        ->map(fn ($driver) => "{$driver->forename} {$driver->surname}")
        ->toArray();

    \Pest\Laravel\get('/drivers?letter=F')
        ->assertSee($names);
});
