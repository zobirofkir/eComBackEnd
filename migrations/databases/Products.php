<?php
namespace database;

use config\Connection;

class Products
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE products ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), description TEXT, price DECIMAL(10, 2), category_id INT, FOREIGN KEY (category_id) REFERENCES categories(id) );";
        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "products table is created";
        }
    }
}