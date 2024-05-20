<?php
namespace database;

use config\Connection;

class Users
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE users (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL)";
        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "users table is created";
        }
    }
}