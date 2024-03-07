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
        if (isset($data['date_ini']) && isset($data['date_fim'])) {
            $sales = $this->salesRepository->getByPeriod($data['date_ini'], $data['date_fim']);
            return [];
        }
        else if (isset($data['date'])) {
            $sales = $this->salesRepository->getByDate($data['date']);
            return [];
        }
        else
            return null;

    }
}
