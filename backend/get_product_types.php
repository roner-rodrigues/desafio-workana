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
if ($method == 'GET') {
    // A requisição é um GET, vamos lidar com isso

    // Criar um novo ProductTypeRepository
    $repository = new ProductTypeRepository($db); // Supondo que $db é o PDO que você configurou

    // Buscar todos os tipos de produto
    $productTypes = $repository->getAllProductTypes();

    // Converter os tipos de produto para arrays
    $productTypesArray = array_map(function($productType) {
        return $productType->toArray();
    }, $productTypes);

    // Retornar os tipos de produto como JSON
    http_response_code(200);
    echo json_encode($productTypesArray);
}
?>
