<?php

require_once 'db_config.php';
require_once 'Order.php';

class OrderRepository 
{
    private $connection;

    public function __construct() 
    {
        global $db;
        $this->connection = $db;
    }

    public function getConnection() 
    {
        return $this->connection;
    }

    public function createOrder(Order $order) 
    {
        try {
            $sql = 'INSERT INTO orders (customer_id, total, total_tax) VALUES (?, ?, ?)';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $order->getCustomerId(), 
                $order->getTotal(), 
                $order->getTotalTax()
            ]);
            
            return true;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getLastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
