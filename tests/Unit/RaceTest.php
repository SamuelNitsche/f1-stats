<?php

declare(strict_types=1);

it('has a round', function (): void {
    $race = App\Models\Race::factory()->create([
        'round' => 1,
    ]);

    expect($race->round)->toBe(1);
});

it('has a starts_at date', function (): void {
    $race = App\Models\Race::factory()->create([
        'starts_at' => now(),
    ]);

    expect($race->starts_at)->toBeInstanceOf(Illuminate\Support\Carbon::class);
});

it('has a name', function (): void {
    $race = App\Models\Race::factory()->create([
        'name' => 'Australian Grand Prix',
    ]);

    expect($race->name)->toBe('Australian Grand Prix');
});

it('has a url', function (): void {
    $race = App\Models\Race::factory()->create([
        'url' => 'https://example.com',
    ]);

    expect($race->url)->toBe('https://example.com');
});

it('can determine if it is a sprint race', function (): void {
    $sprintRace = App\Models\Race::factory()->create([
        'starts_at' => now(),
        'sprint_starts_at' => now(),
    ]);
    expect($sprintRace->isSprintRace())->toBeTrue();

    $regularRace = App\Models\Race::factory()->create([
        'starts_at' => now(),
        'sprint_starts_at' => null,
    ]);
    expect($regularRace->isSprintRace())->toBeFalse();
});
