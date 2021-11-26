<?php

use App\Console\Commands\SyncSeasonsCommand;
use App\Console\Commands\SyncTracksCommand;
use App\Models\Season;
use App\Models\Track;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('it can sync all tracks', function () {
    fakeFormulaOneApi();

    artisan(SyncTracksCommand::class)->assertExitCode(0);

    assertDatabaseHas(Track::class, [
        'slug' => 'imola',
    ]);
    assertDatabaseHas(Track::class, [
        'slug' => 'spa',
    ]);
    assertDatabaseHas(Track::class, [
        'slug' => 'istanbul',
    ]);
});
