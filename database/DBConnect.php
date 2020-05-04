<?php

class DBConnect
{
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->username = 'root';
        $this->password = 'password';
    }

    public function connect()
    {
        $conn = null;
        try {
            $conn = new PDO('mysql:host=localhost;dbname=user_manager', $this->username,$this->password);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $conn;
    }
}

