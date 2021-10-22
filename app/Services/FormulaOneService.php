<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FormulaOneService
{
    const BASE_API_URI = 'https://ergast.com/api/f1';

    public function getAllSeasons()
    {
        return $this->request('/seasons.json?limit=300')['MRData']['SeasonTable']['Seasons'];
    }

    public function getAllRounds($season = 'current')
    {
        return $this->request('/' . $season . '.json')['MRData']['RaceTable']['Races'];
    }

    public function getAllRaces($season = 'current')
    {
        return $this->request('/' . $season . '.json')['MRData']['RaceTable']['Races'];
    }

    public function getLatestSession()
    {
        return $this->request('/current/last/results.json')['MRData']['RaceTable']['Races'];
    }

    public function getAllTracks()
    {
        return $this->request('/circuits.json?limit=300')['MRData']['CircuitTable']['Circuits'];
    }

    public function getAllDrivers($year = null)
    {
        if ($year) {
            return $this->request("/{$year}/drivers.json?limit=1000")['MRData']['DriverTable']['Drivers'];
        }

        return $this->request('/drivers.json?limit=1000')['MRData']['DriverTable']['Drivers'];
    }

    protected function request($endpoint, $headers = [])
    {
        return Http::acceptJson()
            ->get(self::BASE_API_URI . $endpoint)
            ->throw()
            ->json();
    }
}