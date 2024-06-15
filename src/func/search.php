<?php
session_start();
include_once "../config/config.php";
include_once "../config/config_chat.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (user_name LIKE '%{$searchTerm}%' OR user_surname LIKE '%{$searchTerm}%') ";
$output = "";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "user_data.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;
