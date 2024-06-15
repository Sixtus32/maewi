<?php
session_start();
// conectar con la base de datos
require_once("../controllers/bd.users.inc.php");
define('PUBLIC_URL', '/maewi_dev/public/');


$username = $_POST["username"];
$fullname = $_POST["fullname"];
$user_email = $_POST["user_email"];
$user_password = $_POST["user_password"];
$user_password_confirm = $_POST["cpassword"];
$user_profile_image = 'image';
// if ($user_password === ''  || $user_password_confirm === '') {
//     echo "Error: Los campos de las contraseñas no han de estar vacías.";
// } else {
//     if ($user_password === $user_password_confirm) {
registerUser($username, $fullname, $user_email, $user_password, $user_password_confirm, $user_profile_image);
// Mostrar mensaje de éxito y redirigir después de 2 segundos
$userData = getUserData($user_email);
if ($userData) {
    if (!empty($username) && !empty($fullname) && !empty($user_email) && !empty($user_password) && !empty($user_password_confirm)) {
        // Acceder a los datos del usuario
        $user_id = $userData['userId'];
        $unique_id = $userData['unique_id'];
        $user_name = $userData['user_name'];
        $user_surname = $userData['user_surname'];
        $username = $userData['username'];
        $email = $userData['user_email'];
        $user_profile_photo = $userData['user_profile_photo'];
        $_SESSION['unique_id'] = $unique_id;
        $_SESSION['userId'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_surname'] = $user_surname;
        $_SESSION['username'] = $username;
        $_SESSION['user_profile_photo'] = PUBLIC_URL . "assets/img/profile/" . $user_profile_photo;
        echo "success";
    }
}
        // else {
        //     echo "No data";
        // }
//     } else {
//         echo "Las contraseñas han de ser iguales.";
//     }
// }