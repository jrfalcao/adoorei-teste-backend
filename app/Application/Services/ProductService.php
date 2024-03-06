<?php
namespace App\Application\Services;

use App\Domain\Product\Repository\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findProductById($id){
        return $this->productRepository->find($id);
    }

    public function findAllProducts() {
        return $this->productRepository->findAll();
    }
}
