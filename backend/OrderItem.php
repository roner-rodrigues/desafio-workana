<?php

class OrderItem 
{
    private $id;
    private $orderId;
    private $productId;
    private $quantity;
    private $itemPrice;
    private $itemTax;

    public function toArray() 
    {
        return [
            'id'        => $this->getId(),
            'orderId'   => $this->getOrderId(),
            'productId' => $this->getProductId(),
            'quantity'  => $this->getQuantity(),
            'itemPrice' => $this->getItemPrice(),
            'itemTax'   => $this->getItemTax(),
        ];
    }

    // Getters
    public function getId() 
    {
        return $this->id;
    }

    public function getOrderId() 
    {
        return $this->orderId;
    }

    public function getProductId() 
    {
        return $this->productId;
    }

    public function getQuantity() 
    {
        return $this->quantity;
    }

    public function getItemPrice() 
    {
        return $this->itemPrice;
    }

    public function getItemTax() 
    {
        return $this->itemTax;
    }

    // Setters
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setOrderId($orderId) 
    {
        $this->orderId = $orderId;
    }

    public function setProductId($productId) 
    {
        $this->productId = $productId;
    }

    public function setQuantity($quantity) 
    {
        $this->quantity = $quantity;
    }

    public function setItemPrice($itemPrice) 
    {
        $this->itemPrice = $itemPrice;
    }

    public function setItemTax($itemTax) 
    {
        $this->itemTax = $itemTax;
    }
}
