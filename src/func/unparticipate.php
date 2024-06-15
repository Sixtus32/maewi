<?php
session_start();
include_once "../config/config.php";
include_once "../config/config_chat.php";

if (isset($_POST['eventId']) && isset($_SESSION['unique_id'])) {
    $eventId = intval($_POST['eventId']);
    $userId = intval($_SESSION['unique_id']);

    // Remove participation
    $stmt = $mysqli->prepare("DELETE FROM participations WHERE unique_id = ? AND eventId = ?");
    $stmt->bind_param('ii', $userId, $eventId);
    $stmt->execute();
}

header("Location: ../../index.php"); // Redirect back to the events page
exit();
