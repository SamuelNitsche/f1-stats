<?php

declare(strict_types=1);

it('displays all races of the season', function (): void {
    $races = App\Models\Season::findByYear('2022')->races;

    \Pest\Laravel\get('/seasons/2022')
        ->assertSeeInOrder($races->pluck('name')->toArray());
});
