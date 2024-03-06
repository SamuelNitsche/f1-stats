<?php

declare(strict_types=1);

namespace App\Http\Integrations\Ergast\Requests;

use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasRequestPagination;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\PaginationPlugin\OffsetPaginator;

class GetQualifyingResultsRequest extends Request implements Cacheable, HasRequestPagination, Paginatable
{
    /**
     * The HTTP method of the request.
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected string $season,
        protected string $round
    ) {
    }

    /**
     * The endpoint for the request.
     */
    public function resolveEndpoint(): string
    {
        return "/{$this->season}/{$this->round}/qualifying.json";
    }

    public function paginate(Connector $connector): OffsetPaginator
    {
        return new class(connector: $connector, request: $this) extends OffsetPaginator
        {
            protected ?int $perPageLimit = 100;

            protected function isLastPage(Response $response): bool
            {
                return $this->getOffset() >= (int) $response->json('MRData.total');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('MRData.RaceTable.Races');
            }
        };
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store('file'));
    }

    public function cacheExpiryInSeconds(): int
    {
        return 60 * 60 * 24;
    }
}
