<?php
namespace Model;

use QueryBuilder\QueryBuilder;

class Model extends QueryBuilder
{
    private $table;
    private $data;

    public function store()
    {
        $this->insert($this->table, $this->data);
    }
}