<?php

declare(strict_types=1);

it('displays all drivers by first letter of surname', function (): void {
    $names = App\Models\Driver::query()
        ->where('surname', 'like', 'A%')
        ->get(['forename', 'surname'])
        ->map(fn ($driver) => "{$driver->forename} {$driver->surname}")
        ->toArray();

    \Pest\Laravel\get('/drivers')
        ->assertSee($names);
});

it('letter can be filtered in url', function (): void {
    $names = App\Models\Driver::query()
        ->where('surname', 'like', 'F%')
        ->get(['forename', 'surname'])
        ->map(fn ($driver) => "{$driver->forename} {$driver->surname}")
        ->toArray();

    \Pest\Laravel\get('/drivers?letter=F')
        ->assertSee($names);
});
