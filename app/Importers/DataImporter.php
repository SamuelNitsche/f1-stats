<?php

declare(strict_types=1);

namespace App\Importers;

interface DataImporter
{
    public function import(array $data): void;
}
