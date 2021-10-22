<?php

use App\Services\FormulaOneService;

test('it can fetch all available f1 seasons', function () {
    $seasons = app(FormulaOneService::class)->getAllSeasons();

    expect($seasons)->toBeArray();
})->group('integration');
