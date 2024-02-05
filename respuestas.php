<?php
// Incluye el archivo 'database.php' que contiene la función para obtener la conexión a la base de datos
include 'database.php';

// Obtiene la conexión a la base de datos
$conn = database();

try {
    // Recupera los datos enviados por el método POST
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $preguntaElegida = $_POST['preguntaElegida'];

    // Verifica si alguno de los campos está vacío
    if (empty($nombre) || empty($correo) || empty($preguntaElegida)) {
        // Si alguno de los campos está vacío, lanza una excepción
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Prepara la consulta SQL para insertar los datos en la tabla 'Preguntas'
    $sql = "INSERT INTO Preguntas (nombre, correo, preguntaElegida) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // Vincula los parámetros a la consulta SQL
    $stmt->bind_param("sss", $nombre, $correo, $preguntaElegida);
    // Ejecuta la consulta SQL
    $stmt->execute();

    // Prepara la consulta SQL para obtener las preguntas respondidas
    $sql = "SELECT * FROM Preguntas WHERE respondido = 1";
    $result = $conn->query($sql);

    // Verifica si hay preguntas respondidas
    if ($result->num_rows > 0) {
        // Si hay preguntas respondidas, las muestra
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>" . $row["nombre"]. "</strong>: " . $row["preguntaElegida"]. "</p>";
            echo "<p>Respuesta: " . $row["respuesta"]. "</p>";
        }
    } else {
        // Si no hay preguntas respondidas, muestra un mensaje
        echo "No hay preguntas respondidas todavía.";
    }

} catch (Exception $e) {
    // Si ocurre una excepción, muestra el mensaje de la excepción
    echo $e->getMessage();
} finally {
    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
