<?php

namespace App\Domain\Products\Entity\Product;

use App\Infrastructure\Validators\Product\ItemValidatorInterface;

class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $quantity;

    private $itemValidator;

    public function __construct(array $item)
    {
        $this->name = $item['name'];
        $this->price = $item['price'];
        $this->description = $item['description'] || "";
        $this->quantity = $item['quantity'];

        $this->itemValidator = new ItemValidatorInterface;
    }

    public function validateItem(array $item): array
    {
        return $this->itemValidator->validate($item);
    }

    public function create(array $itens): Product {
        return new Product($itens);
    }
}

