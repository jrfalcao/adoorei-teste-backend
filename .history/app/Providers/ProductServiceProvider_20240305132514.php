<?php

namespace App\Providers;

use App\Domain\Products\Validators\ProductItemValidator;
use App\Infrastructure\Validators\ItemValidatorInterface;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ItemValidatorInterface::class, ProductItemValidator::class);
    }
}
