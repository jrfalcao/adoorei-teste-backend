<?php

namespace App\Providers;

use App\Infrastructure\Validators\Product\ItensValidatorInterface;
use App\Infrastructure\Validators\Product\ProductValidateItens;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ItensValidatorInterface::class, ProductValidateItens::class);
    }
}
