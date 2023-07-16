<?php

class Order 
{
    private $id;
    private $customerId;
    private $total;
    private $totalTax;

    public function toArray() 
    {
        return [
            'id'         => $this->getId(),
            'customerId' => $this->getCustomerId(),
            'total'      => $this->getTotal(),
            'totalTax'   => $this->getTotalTax(),
        ];
    }

    // Getters
    public function getId() 
    {
        return $this->id;
    }

    public function getCustomerId() 
    {
        return $this->customerId;
    }

    public function getTotal() 
    {
        return $this->total;
    }

    public function getTotalTax() 
    {
        return $this->totalTax;
    }

    // Setters
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setCustomerId($customerId) 
    {
        $this->customerId = $customerId;
    }

    public function setTotal($total) 
    {
        $this->total = $total;
    }

    public function setTotalTax($totalTax) 
    {
        $this->totalTax = $totalTax;
    }
}
