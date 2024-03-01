<?php

namespace App\Http\Controllers;

use App\Models\Driver;

class CompareDriversController extends Controller
{
    public function show($driver1, $driver2)
    {
        $driver1 = Driver::where('driverRef', $driver1)->firstOrFail();
        $driver2 = Driver::where('driverRef', $driver2)->firstOrFail();

        return view('drivers.compare', [
            'driver1' => $driver1,
            'driver2' => $driver2,
        ]);
    }
}
