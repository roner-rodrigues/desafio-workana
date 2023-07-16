<?php
require_once 'ProductRepository.php';

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
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
