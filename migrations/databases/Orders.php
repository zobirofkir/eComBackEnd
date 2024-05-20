<?php
namespace database;

use config\Connection;

class Orders
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE orders ( id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, status VARCHAR(50), FOREIGN KEY (user_id) REFERENCES users(id) ); ";
        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "orders table is created  ";
        }
    }
}