<?php

namespace App\Infrastructure\Persistence\Modules\Sales\Repositories;

use Illuminate\Support\Facades\DB;
use App\Domain\Sale\Entity\Sales as DomainSale;
use App\Domain\Sale\Repository\SalesRepositoryInterface;
use App\Infrastructure\Eloquent\Sales as EloquentSales;
use App\Infrastructure\Eloquent\SaleProducts;

class SalesEloquentRepository implements SalesRepositoryInterface
{
    public function create($saleData): DomainSale|array {
        $sale = EloquentSales::create($saleData);
        return new DomainSale($sale->id, $sale->amount, $sale->sale_date);
    }

    public function find($id): array {
        return [];
    }

    public function findAll(): array {
        return [];
    }

    public function saveProductsSale($data): bool {

        DB::insert('insert into sale_products (
            sale_id,
            product_id,
            quantity,
            unitary_value)
        values (?, ?, ?, ?)', $data);

        return true;
    }
}
