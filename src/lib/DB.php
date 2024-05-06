<?php

namespace Sixtus\Maewi\lib;

use PDO;
use PDOException;
use Sixtus\Maewi\config\Constants;


class DB
{
    static function connect(): PDO
    {
        try {
            $connection = "mysql:host=" . Constants::$HOST . ";dbname=" . Constants::$DB . ";charset=" . Constants::$CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new PDO($connection, Constants::$USER, Constants::$PASSWORD, $options);
            return $pdo;
        } catch (PDOException $e) {
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}
