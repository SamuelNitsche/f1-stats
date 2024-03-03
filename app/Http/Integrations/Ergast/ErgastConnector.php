<?php

declare(strict_types=1);

namespace App\Http\Integrations\Ergast;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class ErgastConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API.
     */
    public function resolveBaseUrl(): string
    {
        return 'https://ergast.com/api/f1';
    }

    /**
     * Default headers for every request.
     */
    protected function defaultHeaders(): array
    {
        return [];
    }

    /**
     * Default HTTP client options.
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
