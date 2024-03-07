<?php

namespace App\Domain\Product\Repository;

interface ProductRepositoryInterface
{
    public function find($id): array;
    public function findAll(): array;
}
