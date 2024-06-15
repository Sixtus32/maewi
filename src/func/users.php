<?php
session_start();
include_once "../config/config.php";
include_once "../config/config_chat.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY userId DESC";
$query = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "user_data.php";
}
echo $output;
