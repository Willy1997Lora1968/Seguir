<?php
// Conexión a la base de datos
$servername = "server718";
$username =  "u121110840_Ernesto";
$password = "Ireneo1968";
$dbname = "u121110840_Traumatologia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  throw new Exception("La conexión ha fallado: " . $conn->connect_error);
}

return $conn;
?>


