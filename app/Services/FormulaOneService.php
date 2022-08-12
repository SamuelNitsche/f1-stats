<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FormulaOneService
{
    public const DOWNLOAD_URL = 'http://ergast.com/downloads/f1db.sql.gz';

    public function getDatabase(): string
    {
        $file = Http::get(self::DOWNLOAD_URL)->body();

        return Storage::put('f1-database.sql.gz', $file);
    }
}
