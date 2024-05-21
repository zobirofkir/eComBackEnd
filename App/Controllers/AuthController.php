<?php
namespace Controller;

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
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405); // Method Not Allowed
            echo json_encode(["status" => false, "message" => "Method Not Allowed"]);
            return;
        } 

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["email"]) && isset($data["password"])) {
            $username = htmlspecialchars($data["username"]);
            $email = htmlspecialchars($data["email"]);
            $password = $data["password"];

            $this->auth->setRegisterCredentials($username, $email, $password);
            $result = $this->auth->register();

            http_response_code($result ? 200 : 400);
            echo json_encode(["status" => $result]);
        } else {
            http_response_code(400);
            echo json_encode(["status" => false, "message" => "Invalid Input"]);
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405); // Method Not Allowed
            echo json_encode(["status" => false, "message" => "Method Not Allowed"]);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["username"]) && isset($data["password"])) {
            $username = htmlspecialchars($data["username"]);
            $password = $data["password"];

            $this->auth->setLoginCredentials($username, $password);
            $result = $this->auth->login();

            if ($result) {
                http_response_code(200);
                echo json_encode(["status" => true, "token" => $result[0]]);
            } else {
                http_response_code(401); // Unauthorized
                echo json_encode(["status" => false, "message" => "Invalid Credentials"]);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["status" => false, "message" => "Invalid Input"]);
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
    }}
