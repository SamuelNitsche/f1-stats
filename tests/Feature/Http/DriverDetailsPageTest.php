<?php

declare(strict_types=1);

it('displays driver information', function (): void {
    $driver = App\Models\Driver::query()
        ->where('forename', 'Max')
        ->where('surname', 'Verstappen')
        ->firstOrFail();

    \Pest\Laravel\get("/drivers/{$driver->driverRef}")
        ->assertOk();
});
