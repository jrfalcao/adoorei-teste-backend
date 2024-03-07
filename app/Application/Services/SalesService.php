<?php

namespace App\Application\Services;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Domain\Sale\Entity\Sales;
use App\Domain\Sale\Repository\SalesRepositoryInterface;
use Exception;

class SalesService implements SalesServiceInterface
{
    protected $productRepository;
    protected $salesRepository;

    public function __construct(ProductRepositoryInterface $productRepository, SalesRepositoryInterface $salesRepository)
    {
        $this->productRepository = $productRepository;
        $this->salesRepository = $salesRepository;
    }

    public function find(int $id): array {
        return $this->salesRepository->find($id);
    }

    public function createSale(array $saleData): Sales|Array
    {
        try {
            $sale = null;
            $products = [];
            $amauntProductSale = 0;
            foreach ($saleData as $data) {
                $prod = $this->productRepository->find($data['product_id']);
                if (!$prod) {
                    // Produto não encontrado, impossível criar a venda.
                    return null;
                }

                $amauntProductSale += $prod['price'] * $data['quantity'];
                $prod['quantity'] = $data['quantity'];

                array_push($products, $prod);
            }

            $sale = $this->salesRepository->create([
                "amount" => $amauntProductSale,
                "sale_date" => date('Y-m-d H:i:s')
            ]);

            foreach($products as $product) {
                $data = [
                    $sale->getId(),
                    $product['id'],
                    $product['quantity'],
                    floatval($product['price']),
                ];
                $this->salesRepository->saveProductsSale($data);
            }

            $sale->setProductsSale($products);

            return $sale->getArray();
        } catch (Exception $e) {
            // Log da exceção ou tratamento de erro específico
            return null;
        }
    }

    public function getSales($data): ?array {

        if (isset($data['start_date']) && isset($data['end_date']) || isset($data['date'])) {
            $startDate = isset($data['start_date']) ? $data['start_date'] : $data['date'];
            $endDate = isset($data['end_date']) ? $data['end_date'] : $data['date'];
            return $this->salesRepository->getByPeriod($startDate, $endDate);
        }
        else {
            return null;
        }
    }

    public function destroy($id)
    {
        return $this->salesRepository->destroy($id);
    }

    public function updateSale($saleId, $saleData)
    {
        $amauntProductSale = 0;
        foreach ($saleData as $prod) {

            $prodRepository = $this->productRepository->find($prod['product_id']);
            if (!$prodRepository) {
                return null;
            }

            $sale_prod = $this->salesRepository->getSaleProd($saleId, $prod['product_id']);
            if(count($sale_prod) > 0){
                $prod['quantity'] += $sale_prod[0]->quantity;
            }

            $this->salesRepository->saveOrUpdateSaleProd($saleId, $prod['product_id'], $prod['quantity'], $prodRepository['price']);

            $amauntProductSale += $prodRepository['price'] * $prod['quantity'];
        }

        $sale = $this->salesRepository->update($saleId, $amauntProductSale);
        return $sale;
    }
}
