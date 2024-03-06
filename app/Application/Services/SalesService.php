<?php

namespace App\Application\Services;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use Exception;

class SalesService implements SalesServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createSale(array $saleData): ?Array
    {
        try {
            $sale = null; // Placeholder para a instância da venda.
            $product = [];
            foreach ($saleData as $data) {
                $prod = $this->productRepository->find($data['product_id']);
                dd($prod);
                if (!$prod) {
                    // Produto não encontrado, impossível criar a venda.
                    return null;
                }

                $product[] = $prod;

                // Aqui você adicionaria a lógica para criar a venda no banco de dados.
                // Isso poderia envolver a verificação da quantidade disponível, ajuste de estoque,
                // criação do registro da venda, etc.
                // Exemplo:
                // $sale = Sale::create([
                //     'product_id' => $product->id,
                //     'amount' => $data['amount'],
                //     // Outros campos necessários para a venda.
                // ]);

                // Por simplicidade, retornamos a primeira venda criada,
                // mas você pode ajustar a lógica conforme necessário.
                break;
            }

            dd($product);

            return $product;
        } catch (Exception $e) {
            // Log da exceção ou tratamento de erro específico
            return null;
        }
    }
}
