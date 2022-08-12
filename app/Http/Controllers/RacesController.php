<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Season;

class RacesController extends Controller
{
    public function index(Season $season, Race $race)
    {
        return view('rounds.show', [
            'round' => $race,
        ]);
    }
}
