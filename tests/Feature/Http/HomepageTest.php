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

it('shows the last race', function () {
    \Carbon\Carbon::setTestNow('2022-07-30 00:00:00');

    $this->get('/')
        ->assertOk()
        ->assertSee('French Grand Prix');
});

it('shows the current standings', function () {
    \Carbon\Carbon::setTestNow('2022-08-01 00:00:00');

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
