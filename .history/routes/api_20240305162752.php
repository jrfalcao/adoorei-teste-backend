<?php

use App\Domain\Product\Entity\Product;
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
        'name' => 'Produto teste',
        'price' => 150,
        'description' => 'Descrição de teste',
        'quantity' => '10',
    ];

    $product = new Product($itens);
    $product->validateItem($itens);

    dd($product);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
