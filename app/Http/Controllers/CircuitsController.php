<?php

namespace App\Http\Controllers;

use App\Models\Circuit;

class CircuitsController extends Controller
{
    public function index()
    {
        return view('circuits.index', [
            'circuits' => Circuit::orderBy('name')->get(),
        ]);
    }

    public function show(Circuit $circuit)
    {
        return view('circuits.show', [
            'circuit' => $circuit->load('rounds.season', 'rounds.qualification.drivers', 'rounds.race.drivers'),
        ]);
    }
}
