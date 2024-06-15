<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "../config/config.php";
    include_once "../config/config_chat.php";

    $outgoing_id = $_SESSION['unique_id'];

    if (isset($_POST['incoming_id'])) {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        $sql = "SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?)
                OR (outgoing_msg_id = ? AND incoming_msg_id = ?) 
                ORDER BY msg_id";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iiii", $outgoing_id, $incoming_id, $incoming_id, $outgoing_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $msg = htmlspecialchars($row['msg'], ENT_QUOTES, 'UTF-8');
                    if ($row['outgoing_msg_id'] === $outgoing_id) {
                        $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>' . $msg . '</p>
                                        </div>
                                    </div>';
                    } else {
                        $profile_photo = htmlspecialchars($row['user_profile_photo'], ENT_QUOTES, 'UTF-8');
                        $output .= '<div class="chat incoming">
                                        <img src="' . PUBLIC_URL . 'assets/img/profile/' . $profile_photo . '" alt="">
                                        <div class="details">
                                            <p>' . $msg . '</p>
                                        </div>
                                    </div>';
                    }
                }
            } else {
                $output .= '<div class="text">No hay mensajes disponibles. Una vez se envíe un mensaje este aparecerá.</div>';
            }
            mysqli_stmt_close($stmt);
        } else {
            error_log("Error preparando la declaración SQL: " . mysqli_error($conn));
        }
        echo $output;
    } else {
        echo 'incoming_id not set';
    }
} else {
    header("Location: ../../index.php");
    exit();
}
?>
