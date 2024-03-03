<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ErgastService;
use App\Services\FormulaOneService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FormulaOneService::class, fn () => new ErgastService());
    }

    public function boot(): void
    {
        Model::unguard();
        //        Model::preventLazyLoading(! $this->app->isProduction());
    }
}
