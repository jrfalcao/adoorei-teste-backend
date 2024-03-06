<?php

namespace Tests\Feature\App\Presentation\Api\Products;

use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use App\Application\Services\ProductService;
use App\Presentation\Api\Products\ProductPresentation;

class ProductPresentationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function getProductById_returns_product_when_found()
    {
        $productServiceMock = Mockery::mock(ProductService::class);

        $productServiceMock->shouldReceive('findProductById')
            ->with(1)
            ->once()
            ->andReturn(['id' => 1, 'name' => 'Celular 1', 'description' => 'Lorenzo Ipsulum', "price" => "1800.00",
            "quantity" => 50]);

        $productPresentation = new ProductPresentation($productServiceMock);

        $response = $productPresentation->getProductById(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'id' => 1,
            'name' => 'Celular 1',
            'description' => 'Lorenzo Ipsulum',
            "price" => "1800.00",
            "quantity" => 50
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function getAll_returns_all_products()
    {
        $productServiceMock = Mockery::mock(ProductService::class);

        $productServiceMock->shouldReceive('findAllProducts')
            ->once()
            ->andReturn([
                (object) ['id' => 1, 'name' => 'Product 1'],
                (object) ['id' => 2, 'name' => 'Product 2'],
            ]);

        $productPresentation = new ProductPresentation($productServiceMock);

        $response = $productPresentation->findAll();

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
