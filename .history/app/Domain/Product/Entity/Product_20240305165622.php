<?php

namespace App\Domain\Product\Entity;

use App\Infrastructure\Validators\Product\ItemValidatorInterface;

class Product
{
    private $name;
    private $price;
    private $description;
    private $quantity;

    private $itemValidator;

    public function __construct(array $itens)
    {
        $this->setItens($itens);
    }

    public function validateItem(array $item): array
    {
        return $this->itemValidator->validate($item);
    }

    public function create(array $itens): Product {
        return new Product($itens);
    }

    private function setItens($itens) {
        $this->setName($itens['name']);
        $this->setPrice($itens['price']);
        $this->setDescription($itens['description'] || "");
        $this->setQuantity($itens['quantity']);
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}
