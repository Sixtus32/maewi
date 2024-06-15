<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "../config/config.php";
    include_once "../config/config_chat.php";

    $outgoing_id = $_SESSION['unique_id'];

    if (isset($_POST['incoming_id']) && isset($_POST['message'])) {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        
        if (!empty($message)) {
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) 
                    VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iis", $incoming_id, $outgoing_id, $message);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                // Manejo de errores en la preparación de la declaración
                error_log("Error preparando la declaración SQL: " . mysqli_error($conn));
            }
        }
    } else {
        echo "incoming_id or message not set";
    }
} else {
    header("Location: ../../index.php");
    exit();
}
