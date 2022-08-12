<?php

namespace App\Http\Controllers;

use App\Models\Driver;

class DriversController extends Controller
{
    public function index()
    {
        return view('drivers.index', [
            'drivers' => Driver::all(),
        ]);
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', [
            'driver' => $driver->load('seasons'),
        ]);
    }
}
