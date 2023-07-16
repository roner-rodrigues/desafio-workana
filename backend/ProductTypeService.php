<?php
require_once 'ProductTypeRepository.php';

class ProductTypeService
{
    private $productTypeRepository;

    public function __construct()
    {
        $this->productTypeRepository = new ProductTypeRepository();
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
