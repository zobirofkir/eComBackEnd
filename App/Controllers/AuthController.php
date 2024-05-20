<?php
namespace Controller;

use Auth\Auth;

class AuthController 
{
    private $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(["status" => false, "message" => "Method not allowed"]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["email"]) && isset($data["password"]))
        {
            $username = htmlspecialchars($data["username"]);
            $email = htmlspecialchars($data["email"]);
            $password = $data["password"];

            $this->auth->setRegisterCredentials($username, $email, $password);
            $result = $this->auth->register();
            
            http_response_code($result['status'] ? 200 : 400);
            echo json_encode($result);
        }
        else
        {
            http_response_code(400); // Bad Request
            echo json_encode(["status" => false, "message" => "Invalid input"]);
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(false);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["password"]))
        {
            $username = htmlspecialchars($data["username"]);
            $password = $data["password"];

            $this->auth->setLoginCredentials($username, $password);
            $result = $this->auth->login();
            echo json_encode($result);
        }
        else
        {
            http_response_code(400); // Bad Request
            echo json_encode(false);
        }
    }

    public function logout()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
        {
            http_response_code(405); // Method Not Allowed
            echo json_encode(false);
            return;    
        }
        $result = $this->auth->logout();       
        echo json_encode($result);
}
}
