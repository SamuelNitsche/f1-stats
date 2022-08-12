<?php

namespace App\Http\Controllers;

use App\Models\Season;

class SeasonsController extends Controller
{
    public function index()
    {
        return view('seasons.index', [
            'seasons' => Season::orderByDesc('year')->get(),
        ]);
    }

    public function show(Season $season)
    {
        return view('seasons.show', [
            'season' => $season,
        ]);
    }
}
