<?php

namespace App\Infrastructure\Persistence\Modules\Products\Repositories;

use App\Domain\Product\Entity\Product as DomainProduct;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Eloquent\Product as EloquentProduct;
use App\Infrastructure\Validators\Product\ProductValidateItens;
use Illuminate\Validation\Factory;
use stdClass;

class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function find($id): DomainProduct|array
    {
        $eloquentProduct = EloquentProduct::find($id);
        if (!$eloquentProduct) {
            return null;
        }

        return [
            'id' => $eloquentProduct->id,
            'name' => $eloquentProduct->name,
            'description' => $eloquentProduct->description,
            'price' => $eloquentProduct->price,
            'quantity' => $eloquentProduct->quantity
        ];
    }

    public function findAll(): array
    {
        $eloquentProducts = EloquentProduct::all();
        $domainProducts = [];

        foreach ($eloquentProducts as $eloquentProduct) {
            // Novamente, a conversão específica dependerá de como você estruturou a classe DomainProduct.
            $domainProducts[] = new DomainProduct($eloquentProduct->id, $eloquentProduct->name, $eloquentProduct->price, $eloquentProduct->description, $eloquentProduct->quantity);
        }

        return $domainProducts;
    }
}
