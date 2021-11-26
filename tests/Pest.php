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

function fakeFormulaOneApi()
{
    return Http::fake([
        'https://ergast.com/api/f1/seasons.json?limit=300' => Http::response([
            'MRData' => [
                'SeasonTable' => [
                    'Seasons' => [
                        [
                            'season' => '2021',
                            'url' => 'foo',
                        ],
                    ],
                ],
            ],
        ]),
        'https://ergast.com/api/f1/circuits.json*' => Http::response([
            'MRData' => [
                'CircuitTable' => [
                    'Circuits' => [
                        [
                            'circuitId' => 'imola',
                            'url' => 'http://en.wikipedia.org/wiki/Autodromo_Enzo_e_Dino_Ferrari',
                            'circuitName' => 'Autodromo Enzo e Dino Ferrari',
                            'Location' => [
                                'lat' => '44.3439',
                                'long' => '11.7167',
                                'locality' => 'Imola',
                                'country' => 'Italy',
                            ],
                        ],
                        [
                            'circuitId' => 'istanbul',
                            'url' => 'http://en.wikipedia.org/wiki/Istanbul_Park',
                            'circuitName' => 'Istanbul Park',
                            'Location' => [
                                'lat' => '40.9517',
                                'long' => '29.405',
                                'locality' => 'Istanbul',
                                'country' => 'Turkey',
                            ],
                        ],
                        [
                            'circuitId' => 'spa',
                            'url' => 'http://en.wikipedia.org/wiki/Circuit_de_Spa-Francorchamps',
                            'circuitName' => 'Circuit de Spa-Francorchamps',
                            'Location' => [
                                'lat' => '50.4372',
                                'long' => '5.97139',
                                'locality' => 'Spa',
                                'country' => 'Belgium',
                            ],
                        ],
                    ],
                ],
            ],
        ]),
        'https://ergast.com/api/f1/2021.json' => Http::response([
            'MRData' => [
                'RaceTable' => [
                    'Races' => [
                        [
                            'season' => '2021',
                            'round' => '12',
                            'url' => 'http://en.wikipedia.org/wiki/2021_Belgian_Grand_Prix',
                            'raceName' => 'Belgian Grand Prix',
                            'Circuit' => [
                                'circuitId' => 'spa',
                                'url' => 'http://en.wikipedia.org/wiki/Circuit_de_Spa-Francorchamps',
                                'circuitName' => 'Circuit de Spa-Francorchamps',
                                'Location' => [
                                    'lat' => '50.4372',
                                    'long' => '5.97139',
                                    'locality' => 'Spa',
                                    'country' => 'Belgium',
                                ],
                            ],
                            'date' => '2021-08-29',
                            'time' => '13:00:00Z',
                        ],
                        [
                            'season' => '2021',
                            'round' => '2',
                            'url' => 'http://en.wikipedia.org/wiki/2021_Emilia_Romagna_Grand_Prix',
                            'raceName' => 'Emilia Romagna Grand Prix',
                            'Circuit' => [
                                'circuitId' => 'imola',
                                'url' => 'http://en.wikipedia.org/wiki/Autodromo_Enzo_e_Dino_Ferrari',
                                'circuitName' => 'Autodromo Enzo e Dino Ferrari',
                                'Location' => [
                                    'lat' => '44.3439',
                                    'long' => '11.7167',
                                    'locality' => 'Imola',
                                    'country' => 'Italy',
                                ],
                            ],
                            'date' => '2021-04-18',
                            'time' => '13:00:00Z',
                        ],
                        [
                            'season' => '2021',
                            'round' => '16',
                            'url' => 'http://en.wikipedia.org/wiki/2021_Turkish_Grand_Prix',
                            'raceName' => 'Turkish Grand Prix',
                            'Circuit' => [
                                'circuitId' => 'istanbul',
                                'url' => 'http://en.wikipedia.org/wiki/Istanbul_Park',
                                'circuitName' => 'Istanbul Park',
                                'Location' => [
                                    'lat' => '40.9517',
                                    'long' => '29.405',
                                    'locality' => 'Istanbul',
                                    'country' => 'Turkey',
                                ],
                            ],
                            'date' => '2021-10-10',
                            'time' => '12:00:00Z',
                        ],
                    ],
                ],
            ],
        ]),
        'https://ergast.com/api/f1/drivers.json?limit=1000' => Http::response([
            'MRData' => [
                'DriverTable' => [
                    'Drivers' => [
                        [
                            'driverId' => 'alonso',
                            'permanentNumber' => '14',
                            'code' => 'ALO',
                            'url' => 'http://en.wikipedia.org/wiki/Fernando_Alonso',
                            'givenName' => 'Fernando',
                            'familyName' => 'Alonso',
                            'dateOfBirth' => '1981-07-29',
                            'nationality' => 'Spanish',
                        ],
                        [
                            'driverId' => 'bottas',
                            'permanentNumber' => '77',
                            'code' => 'BOT',
                            'url' => 'http://en.wikipedia.org/wiki/Valtteri_Bottas',
                            'givenName' => 'Valtteri',
                            'familyName' => 'Bottas',
                            'dateOfBirth' => '1989-08-28',
                            'nationality' => 'Finnish',
                        ],
                        [
                            'driverId' => 'gasly',
                            'permanentNumber' => '10',
                            'code' => 'GAS',
                            'url' => 'http://en.wikipedia.org/wiki/Pierre_Gasly',
                            'givenName' => 'Pierre',
                            'familyName' => 'Gasly',
                            'dateOfBirth' => '1996-02-07',
                            'nationality' => 'French',
                        ],
                        [
                            'driverId' => 'giovinazzi',
                            'permanentNumber' => '99',
                            'code' => 'GIO',
                            'url' => 'http://en.wikipedia.org/wiki/Antonio_Giovinazzi',
                            'givenName' => 'Antonio',
                            'familyName' => 'Giovinazzi',
                            'dateOfBirth' => '1993-12-14',
                            'nationality' => 'Italian',
                        ],
                        [
                            'driverId' => 'hamilton',
                            'permanentNumber' => '44',
                            'code' => 'HAM',
                            'url' => 'http://en.wikipedia.org/wiki/Lewis_Hamilton',
                            'givenName' => 'Lewis',
                            'familyName' => 'Hamilton',
                            'dateOfBirth' => '1985-01-07',
                            'nationality' => 'British',
                        ],
                        [
                            'driverId' => 'kubica',
                            'permanentNumber' => '88',
                            'code' => 'KUB',
                            'url' => 'http://en.wikipedia.org/wiki/Robert_Kubica',
                            'givenName' => 'Robert',
                            'familyName' => 'Kubica',
                            'dateOfBirth' => '1984-12-07',
                            'nationality' => 'Polish',
                        ],
                        [
                            'driverId' => 'latifi',
                            'permanentNumber' => '6',
                            'code' => 'LAT',
                            'url' => 'http://en.wikipedia.org/wiki/Nicholas_Latifi',
                            'givenName' => 'Nicholas',
                            'familyName' => 'Latifi',
                            'dateOfBirth' => '1995-06-29',
                            'nationality' => 'Canadian',
                        ],
                        [
                            'driverId' => 'leclerc',
                            'permanentNumber' => '16',
                            'code' => 'LEC',
                            'url' => 'http://en.wikipedia.org/wiki/Charles_Leclerc',
                            'givenName' => 'Charles',
                            'familyName' => 'Leclerc',
                            'dateOfBirth' => '1997-10-16',
                            'nationality' => 'Monegasque',
                        ],
                        [
                            'driverId' => 'mazepin',
                            'permanentNumber' => '9',
                            'code' => 'MAZ',
                            'url' => 'http://en.wikipedia.org/wiki/Nikita_Mazepin',
                            'givenName' => 'Nikita',
                            'familyName' => 'Mazepin',
                            'dateOfBirth' => '1999-03-02',
                            'nationality' => 'Russian',
                        ],
                        [
                            'driverId' => 'norris',
                            'permanentNumber' => '4',
                            'code' => 'NOR',
                            'url' => 'http://en.wikipedia.org/wiki/Lando_Norris',
                            'givenName' => 'Lando',
                            'familyName' => 'Norris',
                            'dateOfBirth' => '1999-11-13',
                            'nationality' => 'British',
                        ],
                        [
                            'driverId' => 'ocon',
                            'permanentNumber' => '31',
                            'code' => 'OCO',
                            'url' => 'http://en.wikipedia.org/wiki/Esteban_Ocon',
                            'givenName' => 'Esteban',
                            'familyName' => 'Ocon',
                            'dateOfBirth' => '1996-09-17',
                            'nationality' => 'French',
                        ],
                        [
                            'driverId' => 'perez',
                            'permanentNumber' => '11',
                            'code' => 'PER',
                            'url' => 'http://en.wikipedia.org/wiki/Sergio_P%C3%A9rez',
                            'givenName' => 'Sergio',
                            'familyName' => 'Pérez',
                            'dateOfBirth' => '1990-01-26',
                            'nationality' => 'Mexican',
                        ],
                        [
                            'driverId' => 'raikkonen',
                            'permanentNumber' => '7',
                            'code' => 'RAI',
                            'url' => 'http://en.wikipedia.org/wiki/Kimi_R%C3%A4ikk%C3%B6nen',
                            'givenName' => 'Kimi',
                            'familyName' => 'Räikkönen',
                            'dateOfBirth' => '1979-10-17',
                            'nationality' => 'Finnish',
                        ],
                        [
                            'driverId' => 'ricciardo',
                            'permanentNumber' => '3',
                            'code' => 'RIC',
                            'url' => 'http://en.wikipedia.org/wiki/Daniel_Ricciardo',
                            'givenName' => 'Daniel',
                            'familyName' => 'Ricciardo',
                            'dateOfBirth' => '1989-07-01',
                            'nationality' => 'Australian',
                        ],
                        [
                            'driverId' => 'russell',
                            'permanentNumber' => '63',
                            'code' => 'RUS',
                            'url' => 'http://en.wikipedia.org/wiki/George_Russell_%28racing_driver%29',
                            'givenName' => 'George',
                            'familyName' => 'Russell',
                            'dateOfBirth' => '1998-02-15',
                            'nationality' => 'British',
                        ],
                        [
                            'driverId' => 'sainz',
                            'permanentNumber' => '55',
                            'code' => 'SAI',
                            'url' => 'http://en.wikipedia.org/wiki/Carlos_Sainz_Jr.',
                            'givenName' => 'Carlos',
                            'familyName' => 'Sainz',
                            'dateOfBirth' => '1994-09-01',
                            'nationality' => 'Spanish',
                        ],
                        [
                            'driverId' => 'mick_schumacher',
                            'permanentNumber' => '47',
                            'code' => 'MSC',
                            'url' => 'http://en.wikipedia.org/wiki/Mick_Schumacher',
                            'givenName' => 'Mick',
                            'familyName' => 'Schumacher',
                            'dateOfBirth' => '1999-03-22',
                            'nationality' => 'German',
                        ],
                        [
                            'driverId' => 'stroll',
                            'permanentNumber' => '18',
                            'code' => 'STR',
                            'url' => 'http://en.wikipedia.org/wiki/Lance_Stroll',
                            'givenName' => 'Lance',
                            'familyName' => 'Stroll',
                            'dateOfBirth' => '1998-10-29',
                            'nationality' => 'Canadian',
                        ],
                        [
                            'driverId' => 'tsunoda',
                            'permanentNumber' => '22',
                            'code' => 'TSU',
                            'url' => 'http://en.wikipedia.org/wiki/Yuki_Tsunoda',
                            'givenName' => 'Yuki',
                            'familyName' => 'Tsunoda',
                            'dateOfBirth' => '2000-05-11',
                            'nationality' => 'Japanese',
                        ],
                        [
                            'driverId' => 'max_verstappen',
                            'permanentNumber' => '33',
                            'code' => 'VER',
                            'url' => 'http://en.wikipedia.org/wiki/Max_Verstappen',
                            'givenName' => 'Max',
                            'familyName' => 'Verstappen',
                            'dateOfBirth' => '1997-09-30',
                            'nationality' => 'Dutch',
                        ],
                        [
                            'driverId' => 'vettel',
                            'permanentNumber' => '5',
                            'code' => 'VET',
                            'url' => 'http://en.wikipedia.org/wiki/Sebastian_Vettel',
                            'givenName' => 'Sebastian',
                            'familyName' => 'Vettel',
                            'dateOfBirth' => '1987-07-03',
                            'nationality' => 'German',
                        ],
                    ],
                ],
            ],
        ]),
    ]);
}

function seedTracks()
{
    fakeFormulaOneApi();

    test()->artisan(\App\Console\Commands\SyncTracksCommand::class);
}

function seedSeasons()
{
    fakeFormulaOneApi();

    test()->artisan(\App\Console\Commands\SyncSeasonsCommand::class);
}

function seedRounds()
{
    fakeFormulaOneApi();

    test()->artisan(\App\Console\Commands\SyncRoundsCommand::class);
}

function seedDrivers()
{
    fakeFormulaOneApi();

    test()->artisan(\App\Console\Commands\SyncDriversCommand::class);
}
