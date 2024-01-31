<?php
include 'database.php';

// Hacer una consulta SELECT para obtener todas las preguntas
$result = $conn->query("SELECT * FROM Preguntas");

// Verificar si la consulta devolvió algún resultado
if ($result->num_rows > 0) {
    // Iterar sobre cada fila del resultado
    while($row = $result->fetch_assoc()) {
        // Mostrar los datos de la pregunta
        echo "Nombre: " . $row["nombre"]. " - Correo: " . $row["correo"]. " - Pregunta: " . $row["preguntaElegida"]. "<br>";
    }
} else {
    echo "No hay preguntas en la base de datos.";
}
?>

