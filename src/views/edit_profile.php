<?php
session_start();
include_once "../config/config.php";
include_once "../config/config_chat.php";

// Verificar si el usuario está autenticado
if (!isset($_SESSION['unique_id'])) {
    header("location: ../../index.php");
    exit();
} else {
    // Obtener los datos del usuario actual
    $userId = $_SESSION['unique_id'];
    $sql = $mysqli->query("SELECT * FROM users WHERE unique_id = '$userId'");
    $userData = $sql->fetch_array();
}

// Si se envía el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Recuerda hacer la gestión segura de contraseñas, como el hash

    // Actualizar los datos del usuario en la base de datos
    $updateQuery = $mysqli->query("UPDATE users SET username = '$username', user_email = '$email', user_password = '$password' WHERE unique_id = '$userId'");

    // Redirigir al perfil después de la actualización
    header("Location: profile.php?username=" . $userData['username']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once PARCIALS_FOLDER . "/_meta.php"; ?>
    <title>Editar perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php require_once TEMPLATES_FOLDER . 'nav.php'; ?>
    <div class="wrapper">
        <h1>Editar perfil</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" value="<?php echo $userData['username']; ?>" required>

            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" value="<?php echo $userData['user_email']; ?>" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</body>

</html>