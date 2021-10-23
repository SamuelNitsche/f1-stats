<?php

use App\Console\Commands\SyncRacesCommand;
use App\Models\Race;
use App\Models\Round;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('it can sync all races', function () {
    seedTracks();
    seedSeasons();
    seedRounds();
    seedDrivers();

    artisan(SyncRacesCommand::class)->assertExitCode(0);

    assertDatabaseHas(Race::class, [
        'round_id' => Round::first()->id,
    ]);
});
