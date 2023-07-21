<?php
require_once 'Connection/db_config.php';
require_once 'Repositories/ProductRepository.php';
require_once 'Models/Product.php';  

// Handle CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');
header('Access-Control-Allow-Credentials: true');

// Verify request method
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'OPTIONS') {
    // The request is a preflight request. Respond successfully:
    http_response_code(200);
    exit;
} else if ($method == 'GET') {
    try {
        $productRepository = new ProductRepository($db);

        $products = array_map(function($product) {
            return $product->toArray();
        }, $productRepository->getProducts());

        http_response_code(200);
        echo json_encode($products);
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(['error' => $th->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed."]);
}


