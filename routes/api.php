<?php

use App\Presentation\Api\Products\ProductPresentation;
use App\Presentation\Api\Sales\SalesPresentation;
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

// Route::get('/products/{id}', function ($id, ProductPresentation $productPresentation) {
//     return $productPresentation->getProductById($id);
// });

Route::get('/products/{id}', [ProductPresentation::class, 'getProductById']);
Route::get('/products', [ProductPresentation::class, 'findAll']);

Route::post('/sales', [SalesPresentation::class, 'createSale']);

