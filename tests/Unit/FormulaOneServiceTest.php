<?php

use App\Services\FormulaOneService;

test('it can fetch all available f1 seasons', function () {
    $seasons = app(FormulaOneService::class)->getAllSeasons();

    expect($seasons)->toBeArray();
})->group('integration');

test('it can fetch all F1 tracks', function () {
    $seasons = app(FormulaOneService::class)->getAllTracks();

    expect($seasons)->toBeArray();
})->group('integration');

test('it can fetch all F1 drivers', function () {
    $seasons = app(FormulaOneService::class)->getAllDrivers();

    expect($seasons)->toBeArray();
})->group('integration');
