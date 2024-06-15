<?php
session_start();
require_once("../controllers/bd.users.inc.php");
require_once("../config/config.php");

// Verificar si se ha enviado el formulario
if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
    $user_email = $_POST['user_email'];
    $user_password = hash("sha256", $_POST['user_password']);

    // Iniciar sesión del usuario
    if (logInUser($user_email, $user_password)) {
        // Obtener datos del usuario
        $userData = getUserData($user_email);
        if ($userData) {
            // Establecer variables de sesión
            $_SESSION['unique_id'] = $userData['unique_id'];
            $_SESSION['userId'] = $userData['userId'];
            $_SESSION['user_email'] = $userData['user_email'];
            $_SESSION['user_name'] = $userData['user_name'];
            $_SESSION['user_surname'] = $userData['user_surname'];
            $_SESSION['username'] = $userData['username'];
            $_SESSION['user_profile_photo'] = PUBLIC_URL . "assets/img/profile/" . $userData['user_profile_photo'];
            // Responder con éxito
            echo "success";
        } else {
            echo "No se pudieron obtener los datos del usuario.";
        }
    } else {
        echo "Email y/o contraseñas son incorrectos.";
    }
} else {
    echo "Por favor, complete todos los campos.";
}
?>
