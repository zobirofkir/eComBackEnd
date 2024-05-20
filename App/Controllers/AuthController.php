<?php
namespace Controller;

use Auth\Auth;
use Model\User;

class AuthController 
{
    private $auth;

    public function __construct()
    {
        $this->auth = new User();
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(false);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["email"]) && isset($data["password"]))
        {
            $username = htmlspecialchars($data["username"]);
            $email = htmlspecialchars($data["email"]);
            $password = $data["password"];

            $this->auth->setRegisterCredentials($username, $email, $password);
            $result = $this->auth->register($username, $email, $password);
            
            http_response_code($result['status'] ? 200 : 400);
            echo json_encode($result);
        }
        else
        {
            http_response_code(400);
            echo json_encode(false);
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); # Http Method
            echo json_encode(false);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["password"]))
        {
            $username = htmlspecialchars($data["username"]);
            $password = $data["password"];

            $this->auth->setLoginCredentials($username, $password);
            $result = $this->auth->login($username, $password);
            echo json_encode($result);
        }
        else
        {
            http_response_code(400); #Http Method
            echo json_encode(false);
        }
    }

    public function logout()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); # Http Method
            echo json_encode(false);
            return;    
        }
        $result = $this->auth->logout();       
        echo json_encode($result);
    }
}