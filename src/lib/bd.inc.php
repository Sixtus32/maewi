<?php
class BD_Connection
{
    private $conn;
    function __construct()
    {
        $host = "localhost";
        $database = "maewi_db";
        $user = "root";
        $password = "";
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            return $this->conn;
        } catch (PDOException $e) {
            return false;
        }
    }

    function connection_start()
    {
        return $this->conn;
    }

    function connection_aborted()
    {
        return $this->conn = null;
    }
}
