<?php

namespace App\Providers;

use App\Services\FormulaOneService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FormulaOneService::class, function () {
            return new FormulaOneService;
        });
    }

    public function boot()
    {
        Model::preventLazyLoading(! $this->app->isProduction());
    }
}
