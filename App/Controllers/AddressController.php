<?php
namespace Controller;

use Controller\Controller;
use Model\Address;

class AddressController extends Controller
{
    private $model;

    public function __construct() 
    {
        $this->model = new Address();
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(false);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if ($data && isset($data["address_line1"]) && isset($data["address_line2"]) && isset($data["city"]) && isset($data["state"]) && isset($data["postal_code"]) && isset($data["country"]))
        {
            $address_line1 = htmlspecialchars($data["address_line1"]);
            $address_line2 = htmlspecialchars($data["address_line2"]);
            $city = htmlspecialchars($data["city"]);
            $state = htmlspecialchars($data["state"]);
            $postal_code = htmlspecialchars($data["postal_code"]);
            $country = htmlspecialchars($data["country"]);

            $result = $this->model->storeAddress($address_line1, $address_line2, $city, $state, $postal_code, $country);
            
            http_response_code($result['status'] ? 200 : 400);
            echo json_encode($result);
        }
        else
        {
            http_response_code(400);
            echo json_encode(false);
        }
    }
}
