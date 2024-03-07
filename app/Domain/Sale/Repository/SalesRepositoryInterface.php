<?php

namespace App\Domain\Sale\Repository;

use App\Domain\Sale\Entity\Sales;

interface SalesRepositoryInterface
{
    public function find($id): array;
    public function findAll(): array;
    public function create($saleData): Sales|array;
    public function saveProductsSale($data): bool;
    public function getByPeriod($date_ini, $date_fim);
}
