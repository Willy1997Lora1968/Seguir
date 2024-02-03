<?php
include 'database.php';

$conn = database();

try {
    // Recibir datos del formulario
    $id = $_POST['id'];
    $respuesta = $_POST['respuesta'];

    // Validar los datos
    if (empty($id) || empty($respuesta)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Preparar consulta SQL
    $sql = "UPDATE Preguntas SET respuesta = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta SQL: " . $conn->error);
    }
    $stmt->bind_param("si", $respuesta, $id);

    // Ejecutar consulta SQL
    if (!$stmt->execute()) {
        throw new Exception("Error al insertar la respuesta: " . $stmt->error);
    }

    echo "Respuesta actualizada con éxito";

} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    $conn->close();
}
?>
