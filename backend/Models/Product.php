<?php

class Product 
{
    private $id;
    private $name;
    private $productType;
    private $price;

    public function toArray() 
    {
        return [
            'id'          => $this->getId(),
            'name'        => $this->getName(),
            'price'       => $this->getPrice(),
            'productType' => $this->getProductType()->toArray(),
        ];
    }

    // Getters
    public function getId() 
    {
        return $this->id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getProductType() 
    {
        return $this->productType;
    }

    public function getPrice() 
    {
        return $this->price;
    }

    // Setters
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function setProductType($productType) 
    {
        $this->productType = $productType;
    }

    public function setPrice($price) 
    {
        $this->price = $price;
    }
}
