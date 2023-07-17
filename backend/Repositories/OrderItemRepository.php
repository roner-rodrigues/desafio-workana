<?php
require_once 'Models/OrderItem.php';

class OrderItemRepository 
{
    private $db;

    public function __construct(PDO $db) 
    {
        $this->db = $db;
    }

    public function createOrderItem(OrderItem $orderItem) 
    {
        try {
            $sql = 'INSERT INTO order_items (order_id, product_id, quantity, item_price, item_tax) VALUES (?, ?, ?, ?, ?)';
            $stmt = $this->db->prepare($sql);
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
