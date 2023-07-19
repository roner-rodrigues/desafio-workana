<?php
$host     = "db";
$dbname   = "postgres";
$user     = "postgres";
$password = "password";

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Defina o schema padrão para a sessão atual
    $db->exec("SET search_path TO workana_store");
} catch(PDOException $e) {
    echo $e->getMessage();
}
