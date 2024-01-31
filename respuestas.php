<?php
include 'database.php';

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

<a href="index.html">Inicio</a>
<a href="respuestas.php">Respuestas</a>