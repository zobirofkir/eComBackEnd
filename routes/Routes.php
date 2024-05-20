<?php
namespace Route;

use Controller\AuthController;

class Routes 
{
    private $route;
    private $auth;
    
    public function __construct()
    {
        $this->auth = new AuthController();
    }

    public function routes()
    {
        $this->route = [
            "POST" => [
                "/users/register" => [$this->auth, "register"],
                "/users/login" => [$this->auth, "login"],
                "/users/logout" => [$this->auth, "logout"]
            ],
        ];

        $handleMethod = $_SERVER["REQUEST_METHOD"];
        $handleUrl = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        if (isset($this->route[$handleMethod][$handleUrl]))
        {
            call_user_func($this->route[$handleMethod][$handleUrl]);
            return;
        }
        
        http_response_code(404); // Not Found
        echo json_encode(["status" => false, "message" => "Endpoint not found"]);
    }
}