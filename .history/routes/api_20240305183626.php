<?php

use App\Domain\Product\Entity\Product;
use App\Infrastructure\Validators\Product\ProductValidateItens;
use Illuminate\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/products', function () {
    $itens = [
        'name' => 'Nome de teste do produto',
        'price' => 12.150,
        'description' => 'Descrição de teste',
        'quantity' => 'teste',
    ];

    $product = new Product(new ProductValidateItens(app(Factory::class)));
    $errors = $product->validateItens($itens);

    if (empty($errors)) {
        var_dump("Passou no teste!", $product);
    } else {
        dd("ERROR - Não Passou no teste!", $errors);
    }

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});