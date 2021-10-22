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

    public function getAllTracks()
    {
        return $this->request('/circuits.json?limit=300')['MRData']['CircuitTable']['Circuits'];
    }
    protected function request($endpoint, $headers = [])
    {
        return Http::acceptJson()
            ->get(self::BASE_API_URI . $endpoint)
            ->throw()
            ->json();
    }
}