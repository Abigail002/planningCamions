<?php

namespace App\Providers;

use App\Models\Container;
use App\Observers\ContainerObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Container::observe(ContainerObserver::class);
    }
}
