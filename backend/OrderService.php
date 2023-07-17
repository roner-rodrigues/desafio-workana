<?php
require_once 'OrderRepository.php';
require_once 'OrderItemRepository.php';

class OrderService
{
    private $db;
    private $orderRepository;
    private $orderItemRepository;

    public function __construct(PDO $db) 
    {   
        $this->db = $db;
        $this->orderRepository = new OrderRepository($db);
        $this->orderItemRepository = new OrderItemRepository($db);
    }

    public function createOrder($customerId, $total, $totalTax, $orderItems)
    {
        try {
            // Start the transaction
            $this->db->beginTransaction();

            // Create and insert the order
            $order = new Order();
            $order->setCustomerId($customerId);
            $order->setTotal($total);
            $order->setTotalTax($totalTax);

            $orderId = $this->orderRepository->createOrder($order);

            // Create and insert each of the order items
            foreach ($orderItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->setOrderId($orderId);
                $orderItem->setProductId($item['productId']);
                $orderItem->setQuantity($item['quantity']);
                $orderItem->setItemPrice($item['itemPrice']);
                $orderItem->setItemTax($item['itemTax']);

                $this->orderItemRepository->createOrderItem($orderItem);
            }

            // Commit the transaction
            $this->db->commit();
            
            return true;
        } catch (\Throwable $th) {
            // Rollback the transaction
            $this->db->rollBack();
            
            throw $th;
        }
    }
}
?>
