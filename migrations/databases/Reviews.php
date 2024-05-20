<?php
namespace database;

use config\Connection;

class Reviews
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE reviews ( id INT AUTO_INCREMENT PRIMARY KEY, product_id INT, user_id INT, rating INT, comment TEXT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (product_id) REFERENCES products(id), FOREIGN KEY (user_id) REFERENCES users(id) );";
        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "reviews table is created  ";
        }
    }
}