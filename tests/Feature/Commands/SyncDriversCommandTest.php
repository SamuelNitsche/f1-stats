<?php

use App\Console\Commands\SyncDriversCommand;
use App\Models\Driver;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

test('it can sync all drivers', function () {
    fakeFormulaOneApi();

    artisan(SyncDriversCommand::class)->assertExitCode(0);

    assertDatabaseHas(Driver::class, [
        'slug' => 'max_verstappen',
    ]);
    assertDatabaseHas(Driver::class, [
        'slug' => 'hamilton',
    ]);
    assertDatabaseHas(Driver::class, [
        'slug' => 'bottas',
    ]);
});
