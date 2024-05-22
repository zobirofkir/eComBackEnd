<?php
namespace Controller;

use Controller\Controller;
use Model\Address;

class AddressController extends Controller
{
    public function store()
    {
        /*
            Call The Request Method From The Controller 
        */

        $this->create();
        return $this->service->storeAddress($this->data);
    }
    
    public function all()
    {
        /*
            Call The Request Method From The Controller 
        */
        $this->get();

        $results = $this->model->get();
        echo json_encode($results);
        return;

    }

    public function update()
    {
        $this->put();
        return $this->service->updateAddress($this->data);
    }

    public function delete()
    {
    $this->remove();
    $id = intval($this->data["id"]);
    return $this->model->remove($id);
    }
}
