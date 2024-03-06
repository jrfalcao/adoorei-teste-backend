<?php

namespace App\Infrastructure\Persistence\Modules\Products\Repositories;

use App\Domain\Product\Entity\Product as DomainProduct;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Eloquent\Product as EloquentProduct;

class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function find($id): DomainProduct|array
    {
        $eloquentProduct = EloquentProduct::find($id);
        if (!$eloquentProduct) {
            return [];
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
        $arrayProducts = [];

        foreach ($eloquentProducts as $eloquentProduct) {
            $arrayProducts[] = [
                'id' => $eloquentProduct->id,
                'name' => $eloquentProduct->name,
                'description' => $eloquentProduct->description,
                'price' => $eloquentProduct->price,
                'quantity' => $eloquentProduct->quantity
            ];
        }

        return $arrayProducts;
    }
}
