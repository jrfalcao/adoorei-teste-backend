<?php

namespace App\Domain\Product\Repository;

use App\Domain\Product\Entity\Product;

interface ProductRepositoryInterface
{
    public function find($id): Product|array;
    public function findAll(): array;
}
