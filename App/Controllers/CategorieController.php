<?php
namespace Controller;

class CategorieController extends Controller
{
    public function store()
    {
        $this->create();
        $results = $this->categorie->storeCategorie($this->data);
        echo json_encode($results);
        return;
    }

    public function all()
    {
        $this->get();
        $results = $this->modelCategorie->get();
        echo json_encode($results);
        return;
    }

    public function update()
    {
        $this->put();
        $results = $this->categorie->updateCategorie($this->data);
        echo json_encode($results);
        return;
    }
}