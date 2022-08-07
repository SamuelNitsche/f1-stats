<?php

it('renders the home page', function () {
    \Pest\Laravel\assertDatabaseHas('seasons', [
        'year' => '2022',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee(\App\Models\Season::latest('year')->first()->year);
});

it('shows the next race', function () {
    \Carbon\Carbon::setTestNow('2022-07-30 00:00:00');

    $this->get('/')
        ->assertOk()
        ->assertSee('Hungarian Grand Prix');
});
