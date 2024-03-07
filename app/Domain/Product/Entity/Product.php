<?php

namespace App\Domain\Product\Entity;

use App\Infrastructure\Validators\Product\ItensValidatorInterface;

class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $quantity;

    private $itemValidator;

    public function __construct(ItensValidatorInterface $itemValidator)
    {
        $this->itemValidator = $itemValidator;
    }

    public function validateItens(array $itens): array
    {
        return $this->itemValidator->validate($itens);
    }

    public function create(array $itens): void {
        if( isset($itens['id']) ) $this->setId($itens['id']);
        $this->setName($itens['name']);
        $this->setPrice($itens['price']);
        $this->setDescription($itens['description'] || "");
        $this->setQuantity($itens['quantity']);
        $this->unsetValidate();
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

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function unsetValidate() {
        unset($this->itemValidator);
    }
}

