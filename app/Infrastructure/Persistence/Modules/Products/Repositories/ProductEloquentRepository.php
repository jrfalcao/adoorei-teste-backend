<?php

namespace App\Infrastructure\Persistence\Modules\Products\Repositories;

use App\Infrastructure\Eloquent\Product as EloquentProduct;
use App\Domain\Product\Repository\ProductRepositoryInterface;

class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function find($id): array
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
        $arrayProducts = $this->eloquentToArray($eloquentProducts);
        return $arrayProducts;
    }

    public function eloquentToArray($eloquentProducts): array {
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
