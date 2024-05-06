<?php

require 'vendor/autoload.php';
error_reporting(E_ALL);

use Sixtus\Maewi\controllers\Crud;



$control = new Crud;

if (isset($_REQUEST['op'])) {
    $op = $_REQUEST['op'];

    switch ($op) {
        case "home":
            echo $control->home();
            break;
        case "profile":
            echo $control->profile();
            break;
        default:
            $control->welcome();
    }
} else {
    $control->welcome();
}
