<?php
session_start();
include_once "../config/config.php";
include_once "../config/config_chat.php";

if (isset($_POST['eventId']) && isset($_SESSION['unique_id'])) {
    $eventId = intval($_POST['eventId']);
    $userId = intval($_SESSION['unique_id']);
    echo "Datos registrados";
    // Check if the user is already participating
    $participationResult = $mysqli->query("SELECT * FROM participations WHERE unique_id = $userId AND eventId = $eventId");
    echo "Lectura de datos participación realizada";
    if ($participationResult && $participationResult->num_rows == 0) {
        // Add participation
        $stmt = $mysqli->prepare("INSERT INTO participations (unique_id, eventId) VALUES (?, ?)");
        $stmt->bind_param('ii', $userId, $eventId);
        $stmt->execute();
        echo "Datos insertados";
        header("Location: ../../index.php"); // Redirect back to the events page
    } else {
        echo "Algo anda mal";
        header("Location: event.php"); // Redirect back to the events page
    }
}
