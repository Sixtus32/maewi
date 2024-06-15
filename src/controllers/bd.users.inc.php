<?php
require_once "../lib/bd.inc.php";

function registerUser($username, $fullname, $user_email, $user_password, $user_password_confirm, $image)
{
    try {
        $conn = new BD_Connection();
        // Gestionar la contraseña
        $password = hash("sha256", $user_password);

        // Gestion nombre de usuario
        if (empty($username)) {
            throw new Exception("Por favor, introduzca su nombre de usuario.");
        }


        // Gestionar el nombre completo
        $partOfFullName = explode(" ", $fullname);
        if (isset($partOfFullName[0]) && isset($partOfFullName[1])) {
            $user_name = $partOfFullName[0];
            $user_surname = $partOfFullName[1];
        } else {
            // echo "Por favor, introduzca un nombre completo válido.";
            throw new Exception("Por favor, introduzca un nombre completo válido.");
        }

        // Validar correo electrónico
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            // echo "Por favor, introduzca un correo electrónico válido.";
            throw new Exception("Por favor, introduzca un correo electrónico.");
        }

        // Verificar si el correo electrónico ya está registrado
        if (checkUserEmailRegistration($user_email)) {
            // echo "Este correo electrónico ya está registrado.";
            throw new Exception("Este correo electrónico ya está registrado.");
        }

        if ($user_password !== $user_password_confirm) {
            // echo "Ambas contraseñas deben coincidir";
            throw new Exception("Ambas contraseñas deben coincidir");
        }

        if (empty($user_password) || empty($user_password_confirm)) {
            throw new Exception("Las contraseñas no deben estar vacías");
        }

        // Procesar imagen
        if (isset($_FILES[$image])) {
            $img_name = $_FILES[$image]['name'];
            $img_type = $_FILES[$image]['type'];
            $tmp_name = $_FILES[$image]['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if (!in_array($img_ext, $extensions)) {
                // echo "Por favor, suba un archivo de imagen - jpeg, png, jpg";
                throw new Exception("Por favor, suba un archivo de imagen - jpeg, png, jpg");
            }

            $types = ["image/jpeg", "image/jpg", "image/png"];
            if (!in_array($img_type, $types)) {
                // echo "Por favor, suba un archivo de imagen - jpeg, png, jpg";
                throw new Exception("Por favor, suba un archivo de imagen - jpeg, png, jpg");
            }

            $time = time();
            $new_img_name = $time . $img_name;
            $user_profile_photo = "../../public/assets/img/profile/" . $new_img_name;
            if (!move_uploaded_file($tmp_name, $user_profile_photo)) {
                // echo "¡Algo salió mal! ¡Por favor, inténtalo de nuevo!";
                throw new Exception("¡Algo salió mal! ¡Por favor, inténtalo de nuevo!");
            }
        } else {
            // echo "Por favor, seleccione una imagen de perfil.";
            throw new Exception("Por favor, seleccione una imagen de perfil.");
        }

        // Insertar usuario en la base de datos
        $sqlInsertUser = $conn->connection_start()->prepare("INSERT INTO users
            (userId, unique_id, user_name, user_surname, user_password, username, user_image_banner, user_email, user_profile_photo)
            VALUES (null, :unique_id, :user_name, :user_surname, :user_password, :username, :user_image_banner, :user_email, :user_profile_photo)");
        $sqlInsertUser->bindValue(':unique_id', rand(5000, 100000000));
        $sqlInsertUser->bindValue(':user_name', $user_name);
        $sqlInsertUser->bindValue(':user_surname', $user_surname);
        $sqlInsertUser->bindValue(':user_password', $password);
        $sqlInsertUser->bindValue(':username', '@' . strtolower($username));
        $sqlInsertUser->bindValue(':user_image_banner', '');
        $sqlInsertUser->bindValue(':user_email', strtolower($user_email));
        $sqlInsertUser->bindValue(':user_profile_photo', $new_img_name);
        $sqlInsertUser->execute();

        // Obtener el ID del usuario recién registrado
        $userId = getUserIDSigned($user_email);
        $_SESSION['userId'] = $userId;
        // Insertar cuenta en la base de datos
        $activation_code = rand(time(), 10);
        $status = "Activo ahora";
        $sqlInsertAccount = $conn->connection_start()->prepare("INSERT INTO accounts
            (accountId, account_info, account_activation_code, verified, account_status, account_opening_date, userId)
            VALUES (null, :account_info, :account_activation_code, :verified, :account_status, :account_opening_date, :userId)");

        $sqlInsertAccount->bindValue(':account_info', '');
        $sqlInsertAccount->bindValue(':account_activation_code', $activation_code);
        $sqlInsertAccount->bindValue(':verified', false);
        $sqlInsertAccount->bindValue(':account_status', $status);
        $sqlInsertAccount->bindValue(':account_opening_date', date("Y-m-d"));
        $sqlInsertAccount->bindValue(':userId', $userId);
        $sqlInsertAccount->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// OBTENCIÓN DEL ID DEL USUARIO
function getUserIDSigned($user_email)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $sql = $conn->prepare("SELECT userId FROM users WHERE user_email=:user_email");
        $sql->bindValue(":user_email", $user_email);
        $sql->execute();
        $data = $sql->fetchColumn();
        return $data;
    } catch (PDOException $e) {
        throw new Exception("Error al obtener el ID del usuario: " . $e->getMessage());
    }
}


// COMPROBACIÓN SI PARA VER SI YA EXISTE UN USUARIO CON DICHO EMAIL.
function checkUserEmailRegistration($user_email)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $sql = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email=:user_email");
        $sql->bindValue(':user_email', $user_email);
        $sql->execute(); // ejecuta la consulta
        $data = $sql->fetchColumn();
        $conn = null;
        return ($data == 1);
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
        return false;
    }
}

// // OBTENCIÓN DEL ID DEL USUARIO
// function getUserIDSigned($user_email)
// {
//     try {
//         $connect = new BD_Connection();
//         $conn = $connect->connection_start();
//         $sql = $conn->prepare("SELECT userId FROM users WHERE user_email=:user_email");
//         $sql->bindValue(":user_email", $user_email);
//         $sql->execute();
//         $data = $sql->fetchColumn();
//         return $data;
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//         return null;
//     }
// }

// OBTENCIÓN DEL ID DEL USUARIO
function getUserUniqueID($user_email)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $sql = $conn->prepare("SELECT unique_id FROM users WHERE user_email=:user_email");
        $sql->bindValue(":user_email", $user_email);
        $sql->execute();
        $data = $sql->fetchColumn();
        return $data;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

function getUserData($user_email)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $sql = $conn->prepare("SELECT * FROM users WHERE user_email=:user_email");
        $sql->bindValue(":user_email", $user_email);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data; // Devuelve un array asociativo con los datos del usuario
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

// INICIAR SESSIÓN
function logInUser($user_email, $user_password)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $sql = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email=:user_email AND user_password=:user_password");
        $sql->bindValue(":user_email", $user_email);
        $sql->bindValue(":user_password", $user_password);
        $sql->execute();
        $data = $sql->fetchColumn();
        return ($data == 1);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// ACTUALIZAR EL NOMBRE
function updateUserName($userId, $new_user_name)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        App_Notification::setAppNotificationState(true);
        $sql = $conn->prepare("UPDATE users SET user_name = :new_user_name WHERE userId = :userId");
        $sql->bindValue(":new_user_name", strtolower($new_user_name));
        $sql->bindValue(":userId", $userId);
        $sql->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
// ACTUALIZAR EL APELLIDO
function updateUserPassword($userId, $newPassword)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $encryptedPassword = md5(hash("sha256", $newPassword));
        $sql = $conn->prepare("UPDATE users SET user_password = :newPassword WHERE userId = :userId");
        $sql->bindValue(":newPassword", $encryptedPassword);
        $sql->bindValue(":userId", $userId);
        $sql->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}


// ACTUALIZAR NOMBRE DE USUARIO
function updateUserUsername($userId, $newUsername)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $sql = $conn->prepare("UPDATE users SET username = :newUsername WHERE userId = :userId");
        $sql->bindValue(":newUsername", strtolower($newUsername));
        $sql->bindValue(":userId", $userId);
        $sql->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// ACTUALIZAR EMAIL
function updateUserEmail($userId, $newEmail)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        $sql = $conn->prepare("UPDATE users SET user_email = :newEmail WHERE userId = :userId");
        $sql->bindValue(":newEmail", strtolower($newEmail));
        $sql->bindValue(":userId", $userId);
        $sql->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}


// ACTUALIZAR FOTO DE PERFIL
function updateUserProfilePhoto($userId, $newProfilePhoto)
{
    try {
        $connect = new BD_Connection();
        $conn = $connect->connection_start();
        // comprobación del envio de una imagen
        if (isset($_FILES[$newProfilePhoto])) {
            $img_name = $_FILES[$newProfilePhoto]['name'];
            $img_type = $_FILES[$newProfilePhoto]['type'];
            $tmp_name = $_FILES[$newProfilePhoto]['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if (in_array($img_ext, $extensions)) {
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if (in_array($img_type, $types)) {
                    $time = time();
                    $new_img_name = $time . $img_name;
                    $user_image = "../../public/assets/img/profile/" . $new_img_name;
                    if (move_uploaded_file($tmp_name, $user_image)) {
                        $sql = $conn->prepare("UPDATE users SET user_profile_photo = :newProfilePhoto WHERE userId = :userId");
                        $sql->bindValue(":newProfilePhoto", $newProfilePhoto);
                        $sql->bindValue(":userId", $userId);
                        $sql->execute();
                    } else {
                        return;
                    }
                } else {
                    return;
                }
            } else {
                return;
            }
        } else {
            return;
        }

        return true;
    } catch (PDOException $e) {
        return false;
    }
}


// GENERAR LA IMAGEN PRIMERIZA DEL USUARIO AL REGISTRARSE.
function generateUserImage($texto)
{
    // Crear una imagen en blanco con un fondo de color aleatorio
    $image = imagecreatetruecolor(100, 100);
    $bgColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagefill($image, 0, 0, $bgColor);

    // Establecer el color del texto (blanco)
    $textColor = imagecolorallocate($image, 255, 255, 255);

    // Establecer la fuente y la posición del texto
    $font = '../public/assets/fonts/arial.ttf'; // Reemplaza con la ruta a tu fuente TrueType
    $fontSize = 25;
    $posX = 40;
    $posY = 70;

    // Escribir el texto en la imagen
    imagettftext($image, $fontSize, 0, $posX, $posY, $textColor, $font, $texto);

    // Guardar la imagen en un archivo PNG
    $fileName = '../public/assets/img/userImage/';

    if (!file_exists($fileName)) {
        mkdir($fileName, 0755, true);
    }

    // Guardar la imagen en un archivo PNG
    $imageUrlName = $fileName . 'imagen_generada.png';
    imagepng($image, $imageUrlName);

    // Liberar la memoria
    imagedestroy($image);
}
