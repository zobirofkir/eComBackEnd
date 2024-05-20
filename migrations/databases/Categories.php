<?php
namespace database;

use config\Connection;

class Categories
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE categories ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) UNIQUE );";

        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "categories table is created  ";
        }
    }
}