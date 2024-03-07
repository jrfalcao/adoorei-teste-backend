<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Presentation\Api\Products\ProductPresentation;
use App\Application\Services\ProductServiceInterface;
use Illuminate\Http\Response;

class ProductPresentationTest extends TestCase
{
    use RefreshDatabase;

    private $mockProductService;

    public function setUp(): void
    {
        parent::setUp();

        // Cria um mock do ProductServiceInterface.
        $this->mockProductService = $this->createMock(ProductServiceInterface::class);
    }

    /** @test */
    public function it_returns_product_by_id_when_product_exists()
    {
        $productId = 1;
        $product = ['id' => $productId, 'name' => 'Test Product', 'price' => 100.00];

        // Configura o comportamento esperado do mock.
        $this->mockProductService->method('findProductById')->willReturn($product);

        $productPresentation = new ProductPresentation($this->mockProductService);

        $response = $productPresentation->getProductById($productId);

        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertEquals(json_encode($product), $response->content());
    }

    /** @test */
    public function it_returns_not_found_when_product_does_not_exist()
    {
        $productId = 99;

        // Configura o comportamento esperado do mock.
        $this->mockProductService->method('findProductById')->willReturn(null);

        $productPresentation = new ProductPresentation($this->mockProductService);

        $response = $productPresentation->getProductById($productId);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->status());
        $this->assertEquals(json_encode(['error' => 'Product not found.']), $response->content());
    }

    /** @test */
    public function it_returns_all_products()
    {
        $products = [
            ['id' => 1, 'name' => 'Product 1', 'price' => 100.00],
            ['id' => 2, 'name' => 'Product 2', 'price' => 200.00]
        ];

        // Configura o comportamento esperado do mock.
        $this->mockProductService->method('findAllProducts')->willReturn($products);

        $productPresentation = new ProductPresentation($this->mockProductService);

        $response = $productPresentation->findAll();

        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertEquals(json_encode($products), $response->content());
    }

    /** @test */
    public function it_handles_exceptions_when_retrieving_products()
    {
        // Força o método a lançar uma exceção.
        $this->mockProductService->method('findAllProducts')->will($this->throwException(new \Exception));

        $productPresentation = new ProductPresentation($this->mockProductService);

        $response = $productPresentation->findAll();

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->status());
        $this->assertStringContainsString('An error occurred while retrieving the products.', $response->content());
    }
}
