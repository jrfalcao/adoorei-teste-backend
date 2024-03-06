<?php

namespace App\Application\Services;

interface ProductServiceInterface
{
    public function findProductById($id);
    public function findAllProducts();
}
