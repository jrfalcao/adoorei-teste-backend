<?php

namespace App\Domain\Products\Entity\Product;

use App\Infrastructure\Validators\Product\ItemValidatorInterface;

class Product
{
    private $name;
    private $price;
    private $description;
    private $quantity;

    private $itemValidator;

    public function __construct(array $item)
    {
        $this->setName($item['name']);
        $this->setPrice($item['price']);
        $this->setDescription($item['description'] || "");
        $this->setQuantity($item['quantity']);

    }

    public function validateItem(array $item): array
    {
        $this->itemValidator = new ItemValidatorInterface;
        return $this->itemValidator->validate($item);
    }

    public function create(array $itens): Product {
        return new Product($itens);
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

