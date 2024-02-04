<?php
include 'database.php';

$conn = database();

try {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $preguntaElegida = $_POST['preguntaElegida'];

    if (empty($nombre) || empty($correo) || empty($preguntaElegida)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    $sql = "INSERT INTO Preguntas (nombre, correo, preguntaElegida) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $preguntaElegida);
    $stmt->execute();

    $sql = "SELECT * FROM Preguntas WHERE respondido = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>" . $row["nombre"]. "</strong>: " . $row["preguntaElegida"]. "</p>";
            echo "<p>Respuesta: " . $row["respuesta"]. "</p>";
        }
    } else {
        echo "No hay preguntas respondidas todavía.";
    }

} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    $conn->close();
}
?>
