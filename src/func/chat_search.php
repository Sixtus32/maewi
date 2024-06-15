<?php
session_start();

$outgoing_id = $_SESSION['unique_id'];
$connect = new BD_Connection();

// Obtener el término de búsqueda de la solicitud POST y limpiarlo
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';
$searchTerm = trim($searchTerm); // Eliminar espacios en blanco al principio y al final


// Consulta preparada para evitar la inyección de SQL
$sql = "SELECT * FROM users WHERE NOT unique_id = :outgoing_id AND (username LIKE ? OR user_name LIKE ?)";
$stmt = $connect->connection_start()->prepare($sql);
if ($stmt) {
    // Crear el patrón de búsqueda con comodines
    $searchPattern = "%{$searchTerm}%";

    // Enlazar los parámetros a los marcadores de posición en la consulta
    $stmt->bindValue(":outgoing_id", $outgoing_id, PDO::PARAM_INT);
    $stmt->bindValue(":searchTerm", $searchPattern, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontron resultados
    if ($stmt->rowCount() > 0) {
        // Incluir el archivo de datos para procesar los resultados
        include_once "chat_data.php";
    } else {
        // No se encontraron usuarios relacionados con el término de búsqueda
        echo 'No se encontró ningún usuario con ese nombre';
    }
} else {
    // Manejar errores en la preparación de la consulta
    echo "Error en la búsqueda";
}

// Cerrar la consulta preparada
$stmt->closeCursor();
