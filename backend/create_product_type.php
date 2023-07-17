<?php
// create_product_type.php

require_once  'db_config.php';
require_once  'ProductTypeService.php';

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS, POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'OPTIONS') {
    // The request is a preflight request. Respond successfully:
    http_response_code(200);
    exit;
} else if ($method == 'POST') {
    try {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!empty($data['description']) && !empty($data['taxRate'])) {
            $service = new ProductTypeService($db);

            $service->createProductType($data['description'], $data['taxRate']);

            http_response_code(201);
            echo json_encode(["message" => "Product type was created."]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Unable to fulfil request. Data is incomplete."]);
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(['error' => $th->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed."]);
}
?>
