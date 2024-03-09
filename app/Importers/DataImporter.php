<?php

declare(strict_types=1);

namespace App\Importers;

use Illuminate\Support\Collection;

interface DataImporter
{
    public function import(array $data): void;
}
