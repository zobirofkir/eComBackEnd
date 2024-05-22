<?php
namespace Controller;

use Model\Address;
use Model\Categorie;
use Request\RequestAddress;
use Request\RequestCategorie;

class Controller 
{
    protected $model;
    protected $data;
    protected $requiredFields = [];
    protected $service;
    protected $categorie;
    protected $modelCategorie;


    public function __construct() 
    {
        $this->model = new Address();
        $this->service = new RequestAddress();
        $this->categorie = new RequestCategorie();
        $this->modelCategorie = new Categorie();
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(false);
            return;
        }

        $this->data = json_decode(file_get_contents("php://input"), true);
    }

    public function get()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "GET")
        {
            $results = ["success"=>false];
            echo json_encode($results);
            return;
        }
    }

    public function put()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "PUT")
        {
            $response = ["success"=>false];
            echo json_encode($response);
            return;
        }
        $this->data = json_decode(file_get_contents("php://input"), true);
    }

    public function remove()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "DELETE")
        {
            echo json_encode(false);
            return;
        }
        $this->data = json_decode(file_get_contents("php://input", true));
    }
}