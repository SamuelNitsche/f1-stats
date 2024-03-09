<?php

declare(strict_types=1);

it('has a year', function (): void {
    $season = App\Models\Season::factory()->create([
        'year' => '2021',
    ]);

    expect($season->year)->toBe('2021');
});

it('has a url', function (): void {
    $season = App\Models\Season::factory()->create([
        'url' => 'https://example.com',
    ]);

    expect($season->url)->toBe('https://example.com');
});
