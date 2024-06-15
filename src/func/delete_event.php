<?php
session_start();
include_once "../config/config.php";
include_once "../config/config_chat.php";

// Verificar si el usuario está autenticado
if (!isset($_SESSION['unique_id'])) {
    http_response_code(401); // No autorizado
    exit();
}

// Verificar si se recibió el ID del evento a eliminar
if (!isset($_POST['eventId'])) {
    http_response_code(400); // Solicitud incorrecta
    exit();
}

// Obtener el ID del evento desde la solicitud
$eventId = $_POST['eventId'];

// Verificar si el evento pertenece al usuario autenticado
$userId = $_SESSION['unique_id'];

// Eliminar el evento de la base de datos
$deleteEventQuery = $mysqli->query("DELETE FROM participations WHERE eventId = '$eventId' AND unique_id = '$userId'");
if ($deleteEventQuery) {
    http_response_code(200); // Éxito
} else {
    http_response_code(500); // Error interno del servidor
}


