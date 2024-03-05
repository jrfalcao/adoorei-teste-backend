<?php

namespace App\Domain\Products\Entity\Product;

use InvalidArgumentException;

class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $quantity;

    public function __construct(string $name, float $price, string $description, int $quantity)
    {
        $this->validateName($name);
        $this->validatePrice($price);
        $this->validateQuantity($quantity);

        $this->id = uniqid();
        // $this->created_at = Carbon::now();
        // $this->status = 'ativo';

        $this->name = $name;
        $this->price = $price;
        $this->description = $description || "";
        $this->quantity = $quantity;
    }

}
