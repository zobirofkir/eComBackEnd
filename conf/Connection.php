<?php
namespace config;

use Dotenv\Dotenv;
use PDO;

class Connection
{
    private static $connection;
    
    public function connection()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $DB_CONNECTION = $_ENV["DB_CONNECTION"];
        $DB_HOST = $_ENV["DB_HOST"];
        $DB_PORT = $_ENV["DB_PORT"];
        $DB_DATABASE = $_ENV["DB_DATABASE"];
        $DB_USERNAME = $_ENV["DB_USERNAME"];
        $DB_PASSWORD = $_ENV["DB_PASSWORD"];

        return self::$connection = new PDO("$DB_CONNECTION: host=$DB_HOST; dbname=$DB_DATABASE; charset=utf8", $DB_USERNAME, $DB_PASSWORD);
    }

    /*
        Call Singleton for create one instance
    */

    public function getInstance()
    {
        if (self::$connection === null)
        {
            return self::$connection = $this->connection();
        }
        return self::$connection;
    }
}