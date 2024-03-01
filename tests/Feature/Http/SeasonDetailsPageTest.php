<?php

it('displays all races of the season', function () {
    $races = App\Models\Season::findByYear('2022')->races;

    \Pest\Laravel\get('/seasons/2022')
        ->assertSeeInOrder($races->pluck('name')->toArray());
});
