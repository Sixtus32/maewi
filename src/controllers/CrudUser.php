<?php

namespace Sixtus\Maewi\controllers;

use PDOException;
use Sixtus\Maewi\lib\Controller;
use Sixtus\Maewi\lib\DB;
use Sixtus\Maewi\models\Users;


class CrudUser extends Controller
{

    private Users $users;
    public function __construct()
    {
        parent::__construct();
    }

    public function registerUser($username, $fullname, $user_email, $user_password, $image)
    {
        try {
            $connect = new DB();
            $conn = $connect::connect();
            // gest. contraseña
            $password = hash("sha256", $user_password);
            // gest. nombre completo
            $partOfFullName = explode(" ", $fullname);
            $user_name = $partOfFullName[0];
            $user_surname = $partOfFullName[0];

            if (!empty($username) && !empty($user_name) && !empty($user_surname) && !empty($user_email) && !empty($password)) {
                // filtro para ver si es email valido
                if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    if ($this->checkUserEmailRegistration($user_email)) {
                        $connect::guideMessage("$user_email - Este mail ya existe");
                        return;
                    } else {
                        if (isset($_FILES[$image])) {
                            $img_name = $_FILES['image']['name'];
                            $img_type = $_FILES['image']['type'];
                            $tmp_name = $_FILES['image']['tmp_name'];

                            $img_explode = explode('.', $img_name);
                            $img_ext = end($img_explode);

                            $extensions = ["jpeg", "png", "jpg"];
                            if (in_array($img_ext, $extensions) === true) {
                                $types = ["image/jpeg", "image/jpg", "image/png"];
                                if (in_array($img_type, $types) === true) {
                                    $time = time();
                                    $new_img_name = $time . $img_name;
                                    if (move_uploaded_file($tmp_name, PROFILE_IMAGE_FOLDER . $new_img_name)) {
                                        $ran_id = rand(time(), 100000000);
                                        $activation_code = rand(time(), 1000);
                                        $status = "Active now";
                                        $encrypt_pass = md5($password);
                                        // [ INSERTAR USUARIO ]
                                        // [userId, unique_id, user_name, user_surname, user_password, username, user_image_banner,
                                        // user_emai, user_profile_photo]
                                        $sqlInsertUser = $conn->prepare("INSERT INTO users VALUES
                                        (null,:unique_id,
                                                :user_name,
                                                :user_surname,
                                                :user_password,
                                                :username,
                                                :user_image_banner,
                                                :user_email,
                                                :user_profile_photo)");
                                        $sqlInsertUser->bindValue(':unique_id', $ran_id);
                                        $sqlInsertUser->bindValue(':user_name', $user_name);
                                        $sqlInsertUser->bindValue(':user_surname', $user_surname);
                                        $sqlInsertUser->bindValue(':user_password', $encrypt_pass);
                                        $sqlInsertUser->bindValue(':username', $username);
                                        $sqlInsertUser->bindValue(':user_image_banner', "");
                                        $sqlInsertUser->bindValue(':user_email', $user_email);
                                        $sqlInsertUser->bindValue(':user_profile_photo', $new_img_name);
                                        $sqlInsertUser->execute();
                                        // [ INSERTAR CUENTA ]
                                        // [ accountId, account_info, account_activation_code, account_phone_number, verified,
                                        // account_status, account_opening_date, userId ]
                                        $userId = $this->getUserIDSigned($user_email);
                                        $sqlInsertAccount = $conn->prepare("INSERT INTO accounts VALUES
                                        (
                                            null,
                                            :account_info,
                                            :account_activation_code,
                                            :account_phone_number,
                                            :verified,
                                            :account_status,
                                            :account_opening_date,
                                            :userId
                                        )");
                                        $sqlInsertAccount->bindValue(':account_info', '');
                                        $sqlInsertAccount->bindValue(':account_activation_code', $activation_code);
                                        $sqlInsertAccount->bindValue(':account_phone_number', '');
                                        $sqlInsertAccount->bindValue(':verified', false);
                                        $sqlInsertAccount->bindValue(':account_status', $status);
                                        $sqlInsertAccount->bindValue(':account_opening_date', date("Y-m-d"));
                                        $sqlInsertAccount->bindValue(':userId', $userId);
                                        $sqlInsertAccount->execute();
                                        if ($this->checkUserEmailRegistration($user_email)) {
                                            $_SESSION['unique_id'] = $ran_id;
                                            $_SESSION['user_email'] = $user_email;
                                            $_SESSION['user_name'] = $user_name;
                                            $_SESSION['username'] = $username;
                                            $_SESSION['status'] = $status;
                                            $_SESSION['user_surname'] = $user_surname;
                                            $_SESSION['user_profile_image'] = $new_img_name;
                                            $connect::guideMessage("success");
                                        } else {
                                            $connect::guideMessage("This email address not Exist");
                                        }
                                    } else {
                                        $connect::guideMessage("Something went wrong. Please try again!");
                                    }
                                } else {
                                    $connect::guideMessage("Please upload an image file - jpeg, png, jpg");
                                }
                            }
                        }
                    }
                }
            } else {
                $connect::guideMessage("All input fields are required!");
            }

            return true;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            return false;
        }
    }

    // COMPROBACIÓN SI PARA VER SI YA EXISTE UN USUARIO CON DICHO EMAIL.
    private function checkUserEmailRegistration($user_email)
    {
        try {
            $connect = new DB();
            $conn = $connect::connect();
            $sql = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email=:user_email");
            $sql->bindValue(':user_email', $user_email);
            $sql->execute(); // ejecuta la consulta
            $data = $sql->fetchColumn();
            return ($data == 1);
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
            return false;
        }
    }

    // OBTENCIÓN DEL ID DEL USUARIO
    private function getUserIDSigned($user_email)
    {
        try {
            $connect = new DB();
            $conn = $connect::connect();
            $sql = $conn->prepare("SELECT userId FROM users WHERE user_email=:user_email");
            $sql->bindValue(":user_email", $user_email);
            $sql->execute();
            $data = $sql->fetchColumn();
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function fullnameDivide($fullname)
    {
        // Dividir el nombre completo en nombre y apellido
        $partOfFullname = explode(" ", $fullname);
        // Obtener el nombre y el apellido
        $nombre = $partOfFullname[0];
        $apellido = $partOfFullname[1];
    }
    public function home()
    {
        $this->render("home", Users::getUsers());
    }
    // iniciar sessión
    public function log_in()
    {
        return "";
    }

    // registrarse
    public function check_in()
    {
    }

    public function welcome()
    {
        $this->render("welcome", null);
    }

    public function profile()
    {
        $this->users = new Users($this->get('user_name'), $this->get('user_surname'), $this->get('password'), $this->get('username'));
        $this->render("profile", $this->users);
    }
}
