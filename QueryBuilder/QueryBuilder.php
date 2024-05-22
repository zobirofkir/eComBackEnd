<?php
namespace QueryBuilder;

use config\Connection;
use PDO;

class QueryBuilder
{
    private $conn;
    public function __construct()
    { 
        $connection = new Connection();  
        $this->conn = $connection->getInstance();
    }

    public function insert($table, $data)
    {
        $fields = implode(', ',array_keys($data)); // Line 18 causing the error 
        $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $values = array_values($data);
        return $stmt->execute($values);
    }

    public function get($table, $conditions = [])
    {
        $sql = "SELECT * FROM $table"; 
        $values = [];

        if (!empty($conditions)) {
            $fields = array_keys($conditions);
            $placeholders = implode(' = ? AND ', $fields) . ' = ?';
            $sql .= " WHERE " . $placeholders;
            $values = array_values($conditions);
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function put($table, $data, $conditions)
    {
        $fields = array_keys($data);
        $placeholders = implode(' = ?, ', $fields) . ' = ?';
        $sql = "UPDATE $table SET $placeholders";

        $conditionFields = array_keys($conditions);
        $conditionPlaceholders = implode(' = ? AND ', $conditionFields) . ' = ?';
        $sql .= " WHERE " . $conditionPlaceholders;

        $stmt = $this->conn->prepare($sql);
        $values = array_merge(array_values($data), array_values($conditions));
        return $stmt->execute($values);
    }

    public function remove($table, $conditions)
    {
        $fields = array_keys($conditions);
        $placeholders = implode(' = ? AND ', $fields) . ' = ?';
        $sql = "DELETE FROM $table WHERE " . $placeholders;

        $stmt = $this->conn->prepare($sql);
        $values = array_values($conditions);
        return $stmt->execute($values);
    }
}