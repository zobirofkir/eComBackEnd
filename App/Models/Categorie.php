<?php
namespace Model;

class Categorie extends Model 
{
    private $table = "categories";

    public function create($name)
    {
        $fields = [
            "name"=>$name
        ];

        return $this->store($this->table, $fields);
    }

    public function get()
    {
        return $this->all($this->table);
    }

    public function put($id, $name)
    {
        $field = [
            "name"=>$name
        ];

        $this->condition = [
            "id" => $id
        ];

        return $this->update($this->table, $field, $this->condition);
    }
}