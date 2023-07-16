<?php
require_once 'db_config.php';
require_once 'ProductType.php';

class ProductTypeRepository 
{
    private $connection;

    public function __construct() 
    {
        global $db;
        $this->connection = $db;
    }

    public function createProductType(ProductType $productType) 
    {
        try {
            $sql = 'INSERT INTO product_types (description, tax_rate) VALUES (?, ?)';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $productType->getDescription(), 
                $productType->getTaxRate()
            ]);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getAllProductTypes() 
    {
        try {
            $sql = 'SELECT * FROM product_types';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $productTypes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productType = new ProductType();
                $productType->setId($row['id']);
                $productType->setDescription($row['description']);
                $productType->setTaxRate($row['tax_rate']);
                $productTypes[] = $productType;
            }

            return $productTypes;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getProductTypeById($id) 
    {
        try {
            $sql = 'SELECT * FROM product_types WHERE id = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $productType = new ProductType();
                $productType->setId($row['id']);
                $productType->setDescription($row['description']);
                $productType->setTaxRate($row['tax_rate']);
                return $productType;
            }

            return null; 
        } catch (PDOException $e) {
            throw $e;
        } 
    }
}
