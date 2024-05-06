<?php

namespace Sixtus\Maewi\controllers;

use Sixtus\Maewi\lib\Controller;
use Sixtus\Maewi\models\Users;


class Crud extends Controller
{

    private Users $users;
    public function __construct()
    {
        parent::__construct();
    }
    public function home()
    {
        $this->render("home", Users::getUsers());
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
