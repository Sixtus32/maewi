<?php

namespace Sixtus\Maewi\models;

use Sixtus\Maewi\lib\Model;

class Users extends Model
{
    private int $userId;
    private string $user_name;
    private string $user_surname;
    private string $user_password;
    private string $username;
    private string $user_image_banner;
    private string $user_email;
    private string $user_profile_photo;

    public function __construct(string $user_name, string $user_surname, string $user_password, string $username)
    {
        $this->userId = $this->generateUserId();
        $this->user_name = $user_name;
        $this->user_surname = $user_surname;
        $this->user_password = $user_password;
        $this->username = $username;
        $this->user_image_banner = '';
        $this->user_email = '';
        $this->user_profile_photo = '';
    }

    public function insertUser()
    {
        $query = $this->prepare('INSERT INTO users (userId, user_name, user_surname, user_password, username, user_image_banner, user_email, user_profile_photo)
        VALUES (:userId, :user_name, :user_surname, :user_password, :username, :user_image_banner, :user_email, :user_profile_photo)');
        $query->execute([
            ':userId' => $this->userId,
            ':user_name' => $this->user_name,
            ':user_surname' => $this->user_surname,
            ':user_password' => $this->user_password,
            ':username' => $this->username,
            ':user_image_banner' => $this->user_image_banner,
            ':user_email' => $this->user_email,
            ':user_profile_photo' => $this->user_profile_photo
        ]);
    }

    public function updateUser()
    {
        $query = $this->prepare('UPDATE users SET user_name:user_name, user_surname:user_surname, user_password:user_password, username:username, user_image_banner:user_image_banner, user_email:user_email, user_profile_photo:user_profile_photo, WHERE userId=:userId');
        $query->execute([
            ':userId' => $this->userId,
            ':user_name' => $this->user_name,
            ':user_surname' => $this->user_surname,
            ':user_password' => $this->user_password,
            ':username' => $this->username,
            ':user_image_banner' => $this->user_image_banner,
            ':user_email' => $this->user_email,
            ':user_profile_photo' => $this->user_profile_photo
        ]);
    }

    public static function getUsers()
    {
        $users = [];
        $data = self::query("SELECT * FROM users");

        while ($conn = $data->fetch()) {
            $users[] = new Users($conn['user_name'], $conn['user_surname'], $conn['user_password'], $conn['username']);
        }
        return $users;
    }

    public function deleteUser()
    {
        $query = $this->prepare('DELETE FROM users WHERE userId = :userId');
        $query->execute(['userId' => $this->userId]);
    }

    private function generateUserId()
    {
        $query = $this->query("SELECT max(userId) as userId FROM users");
        $data = $query->fetch();
        return ($data) ? $data['userId'] + 1 : 1;
    }
    public function __get($prop)
    {
        return $this->$prop;
    }
    public function __set($prop, $value)
    {
        $this->$prop = $value;
    }
}
