<?php

require_once  'db_config.php';
require_once  'ProductTypeRepository.php';

// Definir cabeçalhos CORS
header("Access-Control-Allow-Origin: *"); // Substitua por sua origem do React
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
