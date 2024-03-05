<?php

namespace App\Providers;

use App\Infrastructure\Validators\Product\ItensValidatorInterface;
use App\Infrastructure\Validators\Product\ValidateItens;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ItensValidatorInterface::class, ValidateItens::class);
    }
}
