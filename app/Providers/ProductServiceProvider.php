<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Services\ProductServiceInterface;
use App\Infrastructure\Validators\Product\ItensValidatorInterface;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Validators\Product\ProductValidateItens;
use App\Application\Services\ProductService;
use App\Infrastructure\Persistence\Modules\Products\Repositories\ProductEloquentRepository;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ItensValidatorInterface::class, ProductValidateItens::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductEloquentRepository::class);
    }
}
