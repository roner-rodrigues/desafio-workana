<?php
require_once  'Connection/db_config.php';
require_once  'Services/OrderService.php';

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
        // Recover data from body request
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate request body
        if(!empty($data['items']))
            foreach($data['items'] as $item) {
                if (empty($data['productId']) || empty($data['quantity']) ||
                    empty($data['itemPrice']) || empty($data['itemTax'])) {

                    http_response_code(400);
                    echo json_encode(["error" => "Unable to fulfil request. Data is incomplete."]);
                }
            }
        
        // Validate request body
        if (!empty($data['customerId']) && !empty($data['total'] &&
            !empty($data['totalTax']))) {
            $service = new OrderService($db); 

            $result = $service->createOrder($data['customerId'], $data['total'], $data['totalTax'], $data['items']);

            http_response_code(201);
            echo json_encode(['message' => 'Order added successfully.']);;
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
