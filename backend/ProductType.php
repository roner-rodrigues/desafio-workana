<?php

class ProductType 
{
    private $id;
    private $description;
    private $tax_rate;

    public function toArray() 
    {
        return [
            'id'          => $this->getId(),
            'description' => $this->getDescription(),
            'tax_rate'    => $this->getTaxRate(),
        ];
    }

    // Getters
    public function getId() 
    {
        return $this->id;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function getTaxRate() 
    {
        return $this->tax_rate;
    }

    // Setters
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }

    public function setTaxRate($tax_rate) 
    {
        $this->tax_rate = $tax_rate;
    }
}
