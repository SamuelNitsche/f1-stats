<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(Tests\TestCase::class)->in('Feature', 'Unit');
uses(LazilyRefreshDatabase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

//expect()->extend('toBeOne', function () {
//    return $this->toBe(1);
//});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function fakeSeasonsRequest()
{
    return Http::fake([
        'https://ergast.com/api/f1/seasons.json*' => Http::response([
            'MRData' => [
                'SeasonTable' => [
                    'Seasons' => [
                        [
                            'season' => '2021',
                            'url' => 'foo'
                        ],
                        [
                            'season' => '2020',
                            'url' => 'foo'
                        ],
                        [
                            'season' => '2019',
                            'url' => 'foo'
                        ],
                    ]
                ]
            ]
        ]),
    ]);
}


function fakeTracksRequest()
{
    return Http::fake([
        'https://ergast.com/api/f1/circuits.json*' => Http::response([
            'MRData' => [
                'CircuitTable' => [
                    'Circuits' => [
                        [
                            "circuitId" => "imola",
                            "url" => "http://en.wikipedia.org/wiki/Autodromo_Enzo_e_Dino_Ferrari",
                            "circuitName" => "Autodromo Enzo e Dino Ferrari",
                            "Location" => [
                                "lat" => "44.3439",
                                "long" => "11.7167",
                                "locality" => "Imola",
                                "country" => "Italy"
                            ]
                        ],
                        [
                            "circuitId" => "istanbul",
                            "url" => "http://en.wikipedia.org/wiki/Istanbul_Park",
                            "circuitName" => "Istanbul Park",
                            "Location" => [
                                "lat" => "40.9517",
                                "long" => "29.405",
                                "locality" => "Istanbul",
                                "country" => "Turkey"
                            ],
                        ],
                        [
                            "circuitId" => "spa",
                            "url" => "http://en.wikipedia.org/wiki/Circuit_de_Spa-Francorchamps",
                            "circuitName" => "Circuit de Spa-Francorchamps",
                            "Location" => [
                                "lat" => "50.4372",
                                "long" => "5.97139",
                                "locality" => "Spa",
                                "country" => "Belgium"
                            ]
                        ],
                    ]
                ]
            ]
        ]),
    ]);
}

function fakeRoundsRequest()
{
    return Http::fake([
        'https://ergast.com/api/f1/current.json*' => Http::response([
            'MRData' => [
                'RaceTable' => [
                    'Races' => [
                        [
                            "season" => "2021",
                            "round" => "12",
                            "url" => "http://en.wikipedia.org/wiki/2021_Belgian_Grand_Prix",
                            "raceName" => "Belgian Grand Prix",
                            "Circuit" => [
                                "circuitId" => "spa",
                                "url" => "http://en.wikipedia.org/wiki/Circuit_de_Spa-Francorchamps",
                                "circuitName" => "Circuit de Spa-Francorchamps",
                                "Location" => [
                                    "lat" => "50.4372",
                                    "long" => "5.97139",
                                    "locality" => "Spa",
                                    "country" => "Belgium"
                                ]
                            ],
                            "date" => "2021-08-29",
                            "time" => "13:00:00Z"
                        ],
                        [
                            "season" => "2021",
                            "round" => "2",
                            "url" => "http://en.wikipedia.org/wiki/2021_Emilia_Romagna_Grand_Prix",
                            "raceName" => "Emilia Romagna Grand Prix",
                            "Circuit" => [
                                "circuitId" => "imola",
                                "url" => "http://en.wikipedia.org/wiki/Autodromo_Enzo_e_Dino_Ferrari",
                                "circuitName" => "Autodromo Enzo e Dino Ferrari",
                                "Location" => [
                                    "lat" => "44.3439",
                                    "long" => "11.7167",
                                    "locality" => "Imola",
                                    "country" => "Italy"
                                ]
                            ],
                            "date" => "2021-04-18",
                            "time" => "13:00:00Z"
                        ],
                        [
                            "season" => "2021",
                            "round" => "16",
                            "url" => "http://en.wikipedia.org/wiki/2021_Turkish_Grand_Prix",
                            "raceName" => "Turkish Grand Prix",
                            "Circuit" => [
                                "circuitId" => "istanbul",
                                "url" => "http://en.wikipedia.org/wiki/Istanbul_Park",
                                "circuitName" => "Istanbul Park",
                                "Location" => [
                                    "lat" => "40.9517",
                                    "long" => "29.405",
                                    "locality" => "Istanbul",
                                    "country" => "Turkey"
                                ]
                            ],
                            "date" => "2021-10-10",
                            "time" => "12:00:00Z"
                        ],
                    ]
                ]
            ]
        ]),
    ]);
}

function seedTracks()
{
    fakeTracksRequest();

    test()->artisan(\App\Console\Commands\SyncTracksCommand::class);
}

function seedSeasons()
{
    fakeTracksRequest();

    test()->artisan(\App\Console\Commands\SyncSeasonsCommand::class);
}