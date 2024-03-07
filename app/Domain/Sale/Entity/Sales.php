<?php

namespace App\Domain\Sale\Entity;

class Sales
{
    private $id;
    private $amount;
    private $saleDate;
    private $productsSale;

    public function __construct($id, $amount, $saleDate){
        $this->id = $id;
        $this->amount = $amount;
        $this->saleDate = $saleDate;
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

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of saleDate
     */
    public function getSaleDate()
    {
        return $this->saleDate;
    }

    /**
     * Set the value of saleDate
     *
     * @return  self
     */
    public function setSaleDate($saleDate)
    {
        $this->saleDate = $saleDate;

        return $this;
    }

    /**
     * Get the value of productsSale
     */
    public function getProductsSale()
    {
        return $this->productsSale;
    }

    /**
     * Set the value of productsSale
     *
     * @return  self
     */
    public function setProductsSale($productsSale)
    {
        $this->productsSale = $productsSale;

        return $this;
    }

    public function getArray() {
        return [
            "sales_id" => $this->id,
            "amount" => $this->amount,
            "products" => $this->getProductsSale()
        ];
    }
}

