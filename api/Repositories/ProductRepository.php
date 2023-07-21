<?php
require_once 'Models/Product.php';
require_once 'Models/ProductType.php';
require_once 'ProductTypeRepository.php';

class ProductRepository 
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createProduct(Product $product)
{
    try {
        // Data validation and sanitization.
        $name = $product->getName();
        $productTypeId = $product->getProductType();
        $price = $product->getPrice();

        // Validation
        if (!is_string($name) || empty($name)) {
            throw new InvalidArgumentException('Product name must be a non-empty string.');
        }

        if (!is_int($productTypeId)) {
            throw new InvalidArgumentException('Product type ID must be an integer.');
        }

        if (!is_numeric($price) || $price <= 0) {
            throw new InvalidArgumentException('Price must be a positive float.');
        }

        // Sanitization
        $productTypeId = filter_var($productTypeId, FILTER_SANITIZE_NUMBER_INT);
        $price         = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        // Check again after sanitization.
        if (!is_numeric($price)) {
            throw new InvalidArgumentException('Sanitized Price must be a valid number.');
        }
        
        $sql = 'INSERT INTO products (name, product_type_id, price) VALUES (?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $name, 
            $productTypeId,
            $price 
        ]);
    } catch (PDOException $e) {
        // Log the error message.
        error_log($e->getMessage());
        throw $e;
    }
}


    public function getProducts()
    {
        $sql = 'SELECT * FROM products';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($productsData as $productData) {
            $product = new Product();
            $product->setId($productData['id']);
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            
            $productTypeRepo = new ProductTypeRepository($this->db);
            
            $productType = $productTypeRepo->getProductTypeById($productData['product_type_id']);

            $product->setProductType($productType);
            
            $products[] = $product;
        }

        return $products;
    }
}

