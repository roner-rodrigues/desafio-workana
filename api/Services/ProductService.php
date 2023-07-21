<?php
require_once 'Repositories/ProductRepository.php';

class ProductService
{
    private $productRepository;

    public function __construct(PDO $db)
    {
        $this->productRepository = new ProductRepository($db);
    }

    public function createProduct($name, $productTypeId, $price)
    {
        try {
            $product = new Product();
            $product->setName($name);
            $product->setProductType($productTypeId);
            $product->setPrice($price);
            
            $this->productRepository->createProduct($product);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
?>
