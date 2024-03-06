<?php

namespace Tests\Feature\App\Presentation\Api\Products;

use App\Application\Services\ProductService;
use App\Presentation\Api\Products\ProductPresentation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class ProductPresentationTest extends TestCase
{
    use RefreshDatabase;

    public function test_getProductById_returns_product_when_found()
    {
        $productServiceMock = Mockery::mock(ProductService::class);

        $productServiceMock->shouldReceive('findProductById')
            ->with(1)
            ->once()
            ->andReturn((object) ['id' => 1, 'name' => 'Product Name']);

        $productPresentation = new ProductPresentation($productServiceMock);

        $response = $productPresentation->getProductById(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'id' => 1,
            'name' => 'Product Name',
        ], json_decode($response->getContent(), true));
    }

    public function test_getProductById_returns_not_found_when_product_not_found()
    {
        $productServiceMock = Mockery::mock(ProductService::class);

        $productServiceMock->shouldReceive('findProductById')
            ->with(1)
            ->once()
            ->andReturn(null);

        $productPresentation = new ProductPresentation($productServiceMock);

        $response = $productPresentation->getProductById(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(['error' => 'Product not found.'], json_decode($response->getContent(), true));
    }

    public function test_getProductById_returns_internal_server_error_on_exception()
    {
        $productServiceMock = Mockery::mock(ProductService::class);

        $productServiceMock->shouldReceive('findProductById')
            ->with(1)
            ->once()
            ->andThrow(new \Exception('An error occurred.'));

        $productPresentation = new ProductPresentation($productServiceMock);

        $response = $productPresentation->getProductById(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals(['error' => 'An error occurred while retrieving the product.'], json_decode($response->getContent(), true));
    }

    public function test_getAll_returns_all_products()
    {
        $productServiceMock = Mockery::mock(ProductService::class);

        $productServiceMock->shouldReceive('findAllProducts')
            ->once()
            ->andReturn([
                (object) ['id' => 1, 'name' => 'Product 1'],
                (object) ['id' => 2, 'name' => 'Product 2'],
            ]);

        $productPresentation = new ProductPresentation($productServiceMock);

        $response = $productPresentation->getAll();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            [
                'id' => 1,
                'name' => 'Product 1',
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
            ],
        ], json_decode($response->getContent(), true));
    }
}
