<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Season;

class IndexController extends Controller
{
    public function __invoke()
    {
        $currentSeason = Season::with('races')->latest('year')->first();
        //        $previousRound = Race::previous()->first();
        $upcomingRound = Race::upcoming()->first();

        return view('home', [
            'currentSeason' => $currentSeason,
            //            'previousRound' => $previousRound,
            'upcomingRound' => $upcomingRound,
        ]);
    }
}
