<?php
require 'vendor/autoload.php';

function getDbConnection() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Conexión a la base de datos
    $servername = getenv('DB_SERVER');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $dbname = getenv('DB_NAME');

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        error_log("La conexión ha fallado: " . $conn->connect_error);
        return null;
    } else {
        return $conn;
    }
}

// Prueba de la conexión
$conn = getDbConnection();
if ($conn === null) {
    echo "La conexión a la base de datos ha fallado.";
} else {
    echo "La conexión a la base de datos ha sido exitosa.";
}
?>

