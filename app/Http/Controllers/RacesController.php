<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Season;

class RacesController extends Controller
{
    public function index(Season $season, Race $race)
    {
        $race->load(
            'results.status',
            'results.driver',
            'results.race',
            'qualifications.driver',
        );

        return view('rounds.show', [
            'round' => $race,
        ]);
    }
}
