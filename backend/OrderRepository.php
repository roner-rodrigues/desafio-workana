<?php
require_once 'Order.php';

class OrderRepository 
{
    private $db;

    public function __construct(PDO $db) 
    {
        $this->db = $db;
    }

    public function createOrder(Order $order) 
    {
        try {
            // Data validation and sanitization.
            $customerId = $order->getCustomerId();
            $total      = $order->getTotal();
            $totalTax   = $order->getTotalTax();

            if (!is_int($customerId)) {
                throw new InvalidArgumentException('Customer ID must be an integer.');
            }

            if (!is_numeric($total)) {
                throw new InvalidArgumentException('Total must be a float.');
            }

            if (!is_numeric($totalTax)) {
                throw new InvalidArgumentException('Total tax must be a float.');
            }

            // Sanitize the data.
            $customerId = filter_var($customerId, FILTER_SANITIZE_NUMBER_INT);
            $total      = filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $totalTax   = filter_var($totalTax, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            // Check again after sanitization.
            if (!is_numeric($total)) {
                throw new InvalidArgumentException('Sanitized Total must be a valid number.');
            }

            if (!is_numeric($totalTax)) {
                throw new InvalidArgumentException('Sanitized Total Tax must be a valid number.');
            }
            
            $sql = 'INSERT INTO orders (customer_id, total, total_tax) VALUES (?, ?, ?)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $customerId, 
                $total, 
                $totalTax
            ]);

            // Return the ID of the new order.
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Log the error message.
            error_log($e->getMessage());
            throw $e;
        }
    }
}
