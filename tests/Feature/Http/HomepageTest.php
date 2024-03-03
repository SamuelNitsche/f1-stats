<?php

declare(strict_types=1);

it('renders the home page', function (): void {
    App\Models\Season::factory()->create(['year' => 2022]);

    $this->get('/')
        ->assertOk()
        ->assertSee(App\Models\Season::latest('year')->first()->year);
});

it('shows the next session', function (): void {
    Carbon\Carbon::setTestNow('2022-08-13 11:00:00');

    // Next session date: 2022-08-26
    // Next session time: 12:00:00 UTC

    $this->get('/')
        ->assertOk()
        ->assertSee('13 days, 01 hours');
});

it('shows the last race', function (): void {
    Carbon\Carbon::setTestNow('2022-07-30 00:00:00');

    $this->get('/')
        ->assertOk()
        ->assertSee('French Grand Prix');
});

it('shows the current standings', function (): void {
    Carbon\Carbon::setTestNow('2022-08-01 00:00:00');

    $this->get('/')
        ->assertOk()
        ->assertSeeInOrder([
            'Max Verstappen',
            'Charles Leclerc',
            'Sergio Pérez',
            'George Russell',
            'Carlos Sainz',
            'Lewis Hamilton',
            'Lando Norris',
            'Esteban Ocon',
            'Valtteri Bottas',
            'Fernando Alonso',
            'Kevin Magnussen',
            'Daniel Ricciardo',
            'Pierre Gasly',
            'Sebastian Vettel',
            'Mick Schumacher',
            'Yuki Tsunoda',
            'Guanyu Zhou',
            'Lance Stroll',
            'Alexander Albon',
            'Nicholas Latifi',
            'Nico Hülkenberg',
        ]);
});
