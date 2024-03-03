<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Season;

class SeasonsController extends Controller
{
    public function index()
    {
        $latestSeason = Season::orderByDesc('year')->first();

        return redirect()->route('seasons.show', $latestSeason);
    }

    public function show(Season $season)
    {
        //        $standings = $season->getStandings();

        //        $rest = $standings->splice(3);
        //        $podium = $standings;

        return view('seasons.show', [
            'season' => $season,
            'standings' => [
                //                'podium' => $podium,
                //                'rest' => $rest,
            ],
        ]);
    }
}
