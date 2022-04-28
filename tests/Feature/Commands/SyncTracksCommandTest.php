<?php

use App\Console\Commands\SyncSeasonsCommand;
use App\Console\Commands\SyncTracksCommand;
use App\Models\Season;
use App\Models\Circuit;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('it can sync all tracks', function () {
    fakeFormulaOneApi();

    artisan(SyncTracksCommand::class)->assertExitCode(0);

    assertDatabaseHas(Circuit::class, [
        'slug' => 'imola',
    ]);
    assertDatabaseHas(Circuit::class, [
        'slug' => 'spa',
    ]);
    assertDatabaseHas(Circuit::class, [
        'slug' => 'istanbul',
    ]);
});
