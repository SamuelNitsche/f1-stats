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
}