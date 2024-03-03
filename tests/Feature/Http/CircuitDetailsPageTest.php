<?php

declare(strict_types=1);

it('loads the page', function (): void {
    \Pest\Laravel\get('/circuits/spa')
        ->assertOk();
});
