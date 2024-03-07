<?php

namespace App\Infrastructure\Persistence\Modules\Sales\Repositories;

use Illuminate\Support\Facades\DB;
use App\Domain\Sale\Entity\Sales as DomainSale;
use App\Domain\Sale\Repository\SalesRepositoryInterface;
use App\Infrastructure\Eloquent\Sales as EloquentSales;
use App\Infrastructure\Eloquent\SaleProduct;

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

    public function update($saleId, $amount) {
        $sale = EloquentSales::find($saleId);
        $sale->amount = $amount;
        $sale->save();

        return $this->find($saleId);
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

        DB::insert('insert into sale_product (
            sale_id,
            product_id,
            quantity,
            unitary_value)
        values (?, ?, ?, ?)', $data);

        return true;
    }

    public function destroy($id) {
        if($sale = EloquentSales::findOrFail($id)) {
            $sale->delete();

            $saleProducts = SaleProduct::where('sale_id', $id)->get();
            foreach($saleProducts as $saleProduct) {
                DB::table('sale_product')
                    ->where('sale_id', $id)
                    ->update(['deleted_at' => date('Y-m-d H:i:s')]);
            }

            return true;
        }
        return false;
    }

    public function getSaleProd($saleId, $product_id) {
        return SaleProduct::where('sale_id', $saleId)
                ->where('product_id', $product_id)
                ->get();
    }

    public function saveOrUpdateSaleProd($saleId, $productId, $quantity, $price) {
        SaleProduct::updateOrCreate(
                ['sale_id' => $saleId, 'product_id' => $productId],
                ['quantity' => $quantity, 'unitary_value' => $price]
            );
        return $this->getSaleProd($saleId, $productId);
    }
}
