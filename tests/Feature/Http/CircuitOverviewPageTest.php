<?php

use App\Models\Circuit;
use function Pest\Laravel\get;

it('displays all circuits', function () {
    get('/circuits')
        ->assertSeeInOrder(
            Circuit::orderBy('name', 'asc')->pluck('name')->toArray()
        );
});
