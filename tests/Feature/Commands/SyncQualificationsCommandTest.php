<?php

use App\Models\Round;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('it can sync all qualifications', function () {
    seedTracks();
    seedSeasons();
    seedRounds();
    seedDrivers();

    artisan(\App\Console\Commands\SyncQualificationsCommand::class)->assertExitCode(0);

    assertDatabaseHas(\App\Models\Qualification::class, [
        'round_id' => Round::first()->id,
    ]);
});
