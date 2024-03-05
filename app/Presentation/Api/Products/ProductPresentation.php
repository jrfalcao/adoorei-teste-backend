<?php
namespace App\Presentation\Api\Products;

use App\Application\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductPresentation
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Retorna um produto pelo ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getProductById($id): JsonResponse
    {
        try {
            $product = $this->productService->findProductById($id);

            if (!$product) {
                return response()->json(['error' => 'Product not found.'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while retrieving the product.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
