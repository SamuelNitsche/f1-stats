<?php

use App\Console\Commands\SyncSeasonsCommand;
use App\Models\Season;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('it can sync all seasons', function () {
    fakeSeasonsRequest();

    artisan(SyncSeasonsCommand::class)->assertExitCode(0);

    assertDatabaseHas(Season::class, [
        'year' => '2021',
    ]);
});
