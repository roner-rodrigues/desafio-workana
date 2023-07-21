<?php
require_once  'Connection/db_config.php';
session_start();

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
} else if ($method == 'POST') {
    try {
        // Recover data from body request
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $password = $data['password'];
    
        $query = 'SELECT * FROM customers WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->execute([':username' => $username]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
    
        if (isset($row) && password_verify($password, $row['password'])) {
            $_SESSION['logged_in'] = true;
            http_response_code(200);
            echo json_encode(['status' => 'Logged in']);
        } else {
            unset($_SESSION['logged_in']);
            http_response_code(401);
            echo json_encode(['error' => 'Invalid username or password.']);
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(['error' => $th->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed."]);
}
