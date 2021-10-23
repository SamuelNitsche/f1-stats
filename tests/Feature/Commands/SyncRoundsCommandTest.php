<?php

use App\Console\Commands\SyncRoundsCommand;
use App\Models\Round;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('it can sync all rounds', function () {
    fakeFormulaOneApi();
    seedTracks();
    seedSeasons();

    artisan(SyncRoundsCommand::class)->assertExitCode(0);

    assertDatabaseHas(Round::class, [
        'name' => 'Belgian Grand Prix',
        'round' => 12,
    ]);
});
