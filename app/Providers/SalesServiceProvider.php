<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Services\SalesService;
use App\Application\Services\SalesServiceInterface;

class SalesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind( SalesServiceInterface::class, SalesService::class );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
