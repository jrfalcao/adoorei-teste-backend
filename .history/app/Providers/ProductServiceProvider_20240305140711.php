<?php

namespace App\Providers;

use App\Infrastructure\Validators\Product\ItemValidatorInterface;
use App\Infrastructure\Validators\Product\ProductItemValidator;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ItemValidatorInterface::class, ProductItemValidator::class);
    }
}
