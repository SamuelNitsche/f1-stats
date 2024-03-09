<?php

namespace App\Importers;

class CircuitImporter implements DataImporter
{
    public const string orderBy = 'circuitId';

    /**
     * array:9 [
     * "circuitId" => 1
     * "circuitRef" => "albert_park"
     * "name" => "Albert Park Grand Prix Circuit"
     * "location" => "Melbourne"
     * "country" => "Australia"
     * "lat" => -37.8497
     * "lng" => 144.968
     * "alt" => 10
     * "url" => "http://en.wikipedia.org/wiki/Melbourne_Grand_Prix_Circuit"
     * ]
     */
    public function import(array $data): void
    {
        foreach ($data as $circuit) {
            // When retrieving circuit data, we first have to extract the location data
            // and then use it to create a new Location object
            $location = \App\Models\Location::create([
                'lat' => $circuit['lat'],
                'long' => $circuit['lng'],
                'locality' => $circuit['location'],
                'country' => $circuit['country'],
            ]);

            // Then, create the circuit
            \App\Models\Circuit::create([
                'id' => $circuit['circuitId'],
                'slug' => $circuit['circuitRef'],
                'location_id' => $location->id,
                'name' => $circuit['name'],
                'url' => $circuit['url'],
            ]);
        }
    }
}
