<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// actualizar_respuesta.php

// Incluye el archivo de conexión a la base de datos
include 'database.php';

// Conéctate a la base de datos
$conn = getDbConnection();


try {
    // Recoge los valores POST del formulario
    $id = $_POST['id'];
    $respuesta = $_POST['respuesta'];
    
    print_r($_POST); // Agrega esta líne

    // Valida que los campos no estén vacíos
    if (empty($id) || empty($respuesta)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Actualiza la respuesta en la base de datos
    $sql = "UPDATE Preguntas SET respuesta = ?, respondido = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $respuesta, $id);
    $stmt->execute();

    // Muestra un mensaje de éxito
    echo "Respuesta actualizada con éxito";

} catch (Exception $e) {
    // Si hay un error, muéstralo
    echo $e->getMessage();
} finally {
    // Cierra la conexión a la base de datos y redirige al usuario a admin.php
    $conn->close();
    header('Location: admin.php');
}
?>
