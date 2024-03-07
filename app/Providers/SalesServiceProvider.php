<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Services\SalesService;
use App\Application\Services\SalesServiceInterface;
use App\Domain\Sale\Repository\SalesRepositoryInterface;
use App\Infrastructure\Persistence\Modules\Sales\Repositories\SalesEloquentRepository;

class SalesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind( SalesServiceInterface::class, SalesService::class );
        $this->app->bind( SalesRepositoryInterface::class, SalesEloquentRepository::class );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
