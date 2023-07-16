<?php

require_once 'db_config.php';
require_once 'OrderItem.php';

class OrderItemRepository 
{
    private $connection;

    public function __construct() 
    {
        global $db;
        $this->connection = $db;
    }

    public function createOrderItem(OrderItem $orderItem) 
    {
        try {
            $sql = 'INSERT INTO order_items (order_id, product_id, quantity, item_price, item_tax) VALUES (?, ?, ?, ?, ?)';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $orderItem->getOrderId(), 
                $orderItem->getProductId(),
                $orderItem->getQuantity(),
                $orderItem->getItemPrice(),
                $orderItem->getItemTax()
            ]);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
