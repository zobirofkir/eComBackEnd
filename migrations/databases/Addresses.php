<?php
namespace database;

use config\Connection;

class Addresses
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE addresses ( id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, address_line1 VARCHAR(255), address_line2 VARCHAR(255), city VARCHAR(100), state VARCHAR(100), postal_code VARCHAR(20), country VARCHAR(100), FOREIGN KEY (user_id) REFERENCES users(id) ); ";
        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "addresses table is created  ";
        }
    }
}