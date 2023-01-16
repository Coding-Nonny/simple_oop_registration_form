<?php
class Dbconnect
{
    private $user;
    private $pass;
    public function mysqlConnection()
    {
        try {
            $this->user = "root";
            $this->pass = "";
            $connect = new PDO("mysql:host=localhost;dbname=oop", $this->user, $this->pass);
        } catch (PDOException $e) {
            die("Failed connection" . $e->getMessage());
        }
        return $connect;
    }
}
