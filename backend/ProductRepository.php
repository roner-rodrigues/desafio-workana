<?php
require_once 'db_config.php';
require_once 'Product.php';
require_once 'ProductType.php';
require_once 'ProductTypeRepository.php';

class ProductRepository 
{
    private $connection;

    public function __construct()
    {
        global $db;
        $this->connection = $db;
    }

    public function createProduct(Product $product)
    {
        try {
            $sql = 'INSERT INTO products (name, product_type_id, price) VALUES (?, ?, ?)';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $product->getName(), 
                $product->getProductType(),
                $product->getPrice() 
            ]);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getProducts()
    {
        $sql = 'SELECT * FROM products';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($productsData as $productData) {
            $product = new Product();
            $product->setId($productData['id']);
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            
            $productTypeRepo = new ProductTypeRepository();
            
            $productType = $productTypeRepo->getProductTypeById($productData['product_type_id']);

            $product->setProductType($productType);
            
            $products[] = $product;
        }

        return $products;
    }
}

