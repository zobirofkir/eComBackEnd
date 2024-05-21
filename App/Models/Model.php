<?php
namespace Model;

use QueryBuilder\QueryBuilder;

class Model 
{
    private $query;

    public function __construct()
    {
        $this->query = new QueryBuilder();
    }
    
    public function store($table, $data)
    {
        return $this->query->insert($table, $data);
    }

    public function all($table)
    {
        return $this->query->get($table);
    }
}