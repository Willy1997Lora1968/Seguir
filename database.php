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
  die("Connection failed: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$preguntaElegida = $_POST['preguntaElegida'];

// Preparar consulta SQL
$sql = "INSERT INTO Preguntas (nombre, correo, preguntaElegida) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $preguntaElegida);

// Ejecutar consulta SQL
if ($stmt->execute()) {
  echo "Nueva entrada creada con éxito";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

