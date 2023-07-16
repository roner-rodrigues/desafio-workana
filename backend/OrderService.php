<?php
require_once 'OrderRepository.php';
require_once 'OrderItemRepository.php';

class OrderService
{
    private $orderRepository;
    private $orderItemRepository;

    public function __construct()
    {
        $this->orderRepository     = new OrderRepository();
        $this->orderItemRepository = new OrderItemRepository();
    }

    public function createOrder($customerId, $total, $totalTax, $orderItems)
    {
        try {
            // Start the transaction
            $this->orderRepository->getConnection()->beginTransaction();

            // Create and insert the order
            $order = new Order();
            $order->setCustomerId($customerId);
            $order->setTotal($total);
            $order->setTotalTax($totalTax);

            $this->orderRepository->createOrder($order);

            // Get the id of the order we just inserted
            $orderId = $this->orderRepository->getLastInsertId();

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
            $this->orderRepository->getConnection()->commit();
            
            return true;
        } catch (\Throwable $th) {
            // Rollback the transaction
            $this->orderRepository->getConnection()->rollBack();
            
            throw $th;
        }
    }
}
?>
