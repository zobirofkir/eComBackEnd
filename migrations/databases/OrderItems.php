<?php
namespace database;

use config\Connection;

class OrderItems
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function create()
    {
        $sql = "CREATE TABLE order_items ( id INT AUTO_INCREMENT PRIMARY KEY, order_id INT, product_id INT, quantity INT, price DECIMAL(10, 2), FOREIGN KEY (order_id) REFERENCES orders(id), FOREIGN KEY (product_id) REFERENCES products(id) ); ";

        $prepare = $this->db->prepare($sql);;
        if ($prepare->execute())
        {
            echo "oder_items table is created  ";
        }
    }
}