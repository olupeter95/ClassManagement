<?php

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'class_mgmt_system';

    public function getConnection()
    {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if($conn->connect_error){
            die("Failed to connect to Database:"  .$conn->connect_error);
        } else {
            return $conn;
        }
    }
}