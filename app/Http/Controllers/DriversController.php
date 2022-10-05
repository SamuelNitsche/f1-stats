<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function index(Request $request)
    {
        $letter = $request->input('letter', 'A');

        // Group drivers by the first letter of their last name
        $drivers = Driver::query()
            ->where('surname', 'like', "$letter%")
            ->orderBy('surname')
            ->get();

        return view('drivers.index', [
            'drivers' => $drivers,
        ]);
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', [
            'driver' => $driver->load('seasons'),
        ]);
    }
}
