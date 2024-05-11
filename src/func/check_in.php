<?php
// conectar con la base de datos

// toma los datos para el formulario

use Sixtus\Maewi\controllers\CrudUser;

$username = $_POST["username"];
$fullname = $_POST["fullname"];
$user_email = $_POST["user_email"];
$user_password = $_POST["user_password"];
$user_password_confirm = $_POST["cpassword"];
$user_profile_image = 'image';

if ($user_password === $user_password_confirm) {
    $userController = new CrudUser();
    $case = $userController->registerUser($username, $fullname, $user_email, $user_password, $user_profile_image);
    header("refresh:2;url=../../index.php");
} else {
    header("Location:../../index.php");
}
