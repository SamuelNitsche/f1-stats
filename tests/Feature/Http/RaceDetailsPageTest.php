<?php

declare(strict_types=1);

it('displays the standings', function (): void {
    \Pest\Laravel\get('/seasons/2022/13')
        ->assertOk();
});
