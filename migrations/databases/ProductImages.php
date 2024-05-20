<?php
namespace database;

use config\Connection;

class ProductImages
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE product_images ( id INT AUTO_INCREMENT PRIMARY KEY, product_id INT, image_url VARCHAR(255), FOREIGN KEY (product_id) REFERENCES products(id) ); ";

        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "product_images table is created  ";
        }
    }
}