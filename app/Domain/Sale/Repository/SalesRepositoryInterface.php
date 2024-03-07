<?php

namespace App\Domain\Sale\Repository;

use App\Domain\Sale\Entity\Sales;

interface SalesRepositoryInterface
{
    public function find($id): array;
    public function create($saleData): Sales|array;
    public function update($saleId, $amount);
    public function destroy($id);
    public function saveProductsSale($data): bool;
    public function getByPeriod($start_date, $end_date);
    public function getByDate($date);
    public function getSaleProd($saleId, $product_id);
    public function saveOrUpdateSaleProd($saleId, $prodId, $quantity, $price);
}
