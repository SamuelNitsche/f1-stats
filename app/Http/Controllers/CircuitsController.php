<?php

namespace App\Http\Controllers;

use App\Models\Circuit;

class CircuitsController extends Controller
{
    public function index()
    {
        $circuits = Circuit::all()
            ->sortBy(fn(Circuit $circuit) => $circuit->name)
            ->sortBy(fn(Circuit $circuit) => !$circuit->hasImage());

        return view('circuits.index', [
            'circuits' => $circuits,
        ]);
    }

    public function show(Circuit $circuit)
    {
        return view('circuits.show', [
            'circuit' => $circuit->load('rounds.season', 'rounds.qualification.drivers', 'rounds.race.drivers'),
        ]);
    }
}
