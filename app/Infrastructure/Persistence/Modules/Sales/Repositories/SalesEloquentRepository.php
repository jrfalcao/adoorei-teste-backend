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
        $sale = EloquentSales::find($id);
        $products = $this->getProducts($sale->id);
        $domainSale = new DomainSale($sale->id, $sale->amount, $sale->sale_date);
        $domainSale->setProductsSale($products);

        return $domainSale->getArray();
    }

    public function getByPeriod($start_date, $end_date) {
        $sales = EloquentSales::whereBetween('sale_date', [$start_date, $end_date])->get();
        $salesArray = [];

        foreach($sales as $sale){
            $products = $this->getProducts($sale->id);

            $domainSale = new DomainSale($sale->id, $sale->amount, $sale->sale_date);

            $domainSale->setProductsSale($products);
            $salesArray[] = $domainSale->getArray();
        }

        return $salesArray;
    }

    private function getProducts($saleId)
    {
        return DB::table('sale_product')
                ->join('products', 'sale_product.product_id', '=', 'products.id')
                ->select('products.id', 'products.name', 'products.price', 'sale_product.quantity')
                ->where('sale_product.sale_id', '=', $saleId)
                ->get()
                ->toArray();
    }

    public function getByDate($date) {

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
