<?php
include 'database.php';

$conn = database();

try {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $preguntaElegida = $_POST['preguntaElegida'];

    // Validar los datos
    if (empty($nombre) || empty($correo) || empty($preguntaElegida)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Preparar consulta SQL
    $sql = "INSERT INTO Preguntas (nombre, correo, preguntaElegida) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta SQL: " . $conn->error);
    }
    $stmt->bind_param("sss", $nombre, $correo, $preguntaElegida);

    // Ejecutar consulta SQL
    if (!$stmt->execute()) {
        throw new Exception("Error al insertar los datos: " . $stmt->error);
    }

    echo "Nueva entrada creada con éxito";

    // Preparar consulta SQL para obtener las preguntas
    $sql = "SELECT * FROM Preguntas";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Salida de cada fila
      while($row = $result->fetch_assoc()) {
        echo "<p><strong>" . $row["nombre"]. "</strong>: " . $row["preguntaElegida"]. "</p>";
      }
    } else {
      echo "No hay preguntas todavía.";
    }

} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    $conn->close();
}
?>
