<?php
require_once 'Repositories/ProductTypeRepository.php';

class ProductTypeService
{
    private $productTypeRepository;

    public function __construct(PDO $db)
    {
        $this->productTypeRepository = new ProductTypeRepository($db);
    }

    public function createProductType($description, $taxRate)
    {
        try {
            $productType = new ProductType();
            $productType->setDescription($description);
            $productType->setTaxRate($taxRate);
            
            $this->productTypeRepository->createProductType($productType);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
