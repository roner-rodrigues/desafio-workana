<?php
require_once 'Connection/db_config.php';
require_once 'Repositories/ProductRepository.php';
require_once 'Models/Product.php';  

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$productRepository = new ProductRepository($db);

// $products = $productRepository->getProducts();
$products = array_map(function($product) {
    return $product->toArray();
}, $productRepository->getProducts());

echo json_encode($products);
