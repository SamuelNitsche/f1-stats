<?php

it('displays driver information', function () {
    $driver = \App\Models\Driver::query()
        ->where('forename', 'Max')
        ->where('surname', 'Verstappen')
        ->firstOrFail();

    \Pest\Laravel\get("/drivers/$driver->driverRef")
        ->assertOk();
});
