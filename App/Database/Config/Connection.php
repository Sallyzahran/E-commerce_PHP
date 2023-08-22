<?php

namespace App\Database\Config;



class Connection {

    private string $db_hostname = 'localhost';
    private string $db_username = 'sallyz';
    private string $db_password = '123';
    private string $db_name = 'ecommerce_php';
    protected \mysqli $conn;


    public function __construct()
    {

        $this->conn = new \mysqli($this->db_hostname,$this->db_username,$this->db_password,$this->db_name);
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}

new Connection;

