<?php
namespace sixtus\maewi\models;

use sixtus\maewi\lib\Model;


class Administrator extends Model
{
    private int $adminId;
    private string $email;
    private string $password;
    private string $admin_profile_photo;
    private string $admin_username;

    public function __construct(
        string  $email,
        string $password,
        string $admin_profile_photo,
        string $admin_username
    )
    {
        $this->adminId = $this->generateAdminId();
        $this->email = $email;
        $this->password = $password;
        $this->admin_profile_photo = $admin_profile_photo;
        $this->admin_username = $admin_username;
    }

    public function insertAdmin()
    {
        $query = $this->prepare('INSERT INTO administrators
        (
            adminId,
            email,
            password,
            admin_profile_photo,
            admin_username
        )
        VALUES
        (
            :adminId,
            :email,
            :password,
            :admin_profile_photo,
            :admin_username
        )
        ');
        $query->execute([
            ':adminId' => $this->adminId,
            ':email' => $this->email,
            ':password' => $this->password,
            ':admin_profile_photo' => $this->admin_profile_photo,
            ':admin_username' => $this->admin_username
        ]);
    }


    public function updateAdmin()
    {
        $query = $this->prepare('UPDATE administrators SET
        adminId=:adminId,
        email=:email,
        password=:password,
        admin_profile_photo=:admin_profile_photo,
        admin_username=:admin_username,
        WHERE adminId=:adminId');
        $query->execute([
            ':adminId' => $this->adminId,
            ':email' => $this->email,
            ':password' => $this->password,
            ':admin_profile_photo' => $this->admin_profile_photo,
            ':admin_username' => $this->admin_username
        ]);
    }

    private function deleteAdmin()
    {
        $query = $this->prepare('');
        $query->execute([]);
    }

    private function generateAdminId(){
        $query=$this->query("");
        $data=$query->fetch();
        return ($data)?$data['adminId']+1:1;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $value)
    {
        $this->$prop=$value;
    }

}