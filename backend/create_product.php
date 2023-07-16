<?php
require_once  'db_config.php';
require_once  'ProductService.php';

// Handle CORS
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS, POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Verify request method
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'OPTIONS') {
    // The request is a preflight request. Respond successfully:
    http_response_code(200);
    exit;
} else if ($method == 'POST') {
    try {
        // Recover data in body request
        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['name']) && !empty($data['productType'] &&
            !empty($data['price']))) {
            $service = new ProductService($db); 

            $result = $service->createProduct($data['name'], $data['productType'], $data['price']);

            http_response_code(201);
            echo json_encode(['message' => 'Product added successfully.']);;
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
