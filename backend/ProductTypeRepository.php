<?php
require_once 'ProductType.php';

class ProductTypeRepository 
{
    private $db;

    public function __construct(PDO $db) 
    {
        $this->db = $db;
    }

    public function createProductType(ProductType $productType) 
    {
        try {
            // Data validation and sanitization.
            $description = $productType->getDescription();
            $taxRate     = $productType->getTaxRate();

            if (!is_string($description) || empty($description)) {
                throw new InvalidArgumentException('Description must be a non-empty string.');
            }

            if (!is_numeric($taxRate)) {
                throw new InvalidArgumentException('Tax Rate must be a valid number.');
            }
            
            // Sanitize the data.
            $taxRate = filter_var($taxRate, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            // Check again after sanitization.
            if (!is_numeric($taxRate)) {
                throw new InvalidArgumentException('Sanitized Tax Rate must be a valid number.');
            }
            
            $sql = 'INSERT INTO product_types (description, tax_rate) VALUES (?, ?)';
            $stmt = $this->db->prepare($sql);
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
            $stmt = $this->db->prepare($sql);
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
            $stmt = $this->db->prepare($sql);
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
