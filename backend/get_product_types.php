<?php
require_once  'Connection/db_config.php';
require_once  'Repositories/ProductTypeRepository.php';

// Handle CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');
header('Access-Control-Allow-Credentials: true');

// Verificar o método da requisição
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'OPTIONS') {
    // The request is a preflight request. Respond successfully:
    http_response_code(200);
    exit;
} else if ($method == 'GET') {
    try {
        $repository = new ProductTypeRepository($db); 
    
        $productTypes = $repository->getAllProductTypes();
    
        $productTypesArray = array_map(function($productType) {
            return $productType->toArray();
        }, $productTypes);

        http_response_code(200);
        echo json_encode($productTypesArray);
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(['error' => $th->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed."]);
}
?>
