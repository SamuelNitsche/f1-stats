<?php

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
        return view('seasons.show', [
            'season' => $season,
        ]);
    }
}
