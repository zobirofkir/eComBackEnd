<?php
namespace Model;

use QueryBuilder\QueryBuilder;

class Model 
{
    private $query;
    protected $condition;

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

    public function update ($table, $data, $condition = [])
    {
        return $this->query->put($table, $data, $condition);
    }

    public function delete($table, $condition = [])
    {
        return $this->query->remove($table, $condition);
    }
}
