<?php

declare(strict_types=1);

use App\Models\Circuit;

use function Pest\Laravel\get;

it('displays all circuits', function (): void {
    get('/circuits')
        ->assertSee(
            Circuit::orderBy('name', 'asc')->pluck('name')->toArray()
        );
});
