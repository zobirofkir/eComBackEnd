<?php
namespace Route;

use Controller\AuthController;
use Controller\AddressController;
use Middleware\Middleware;

class Routes 
{
    private $route;
    private $controller;
    private $add;
    private $middleware;
    
    public function __construct()
    {
        $this->controller = new AuthController();
        $this->add = new AddressController();
        $this->middleware = new Middleware();
    }

    public function routes()
    { 
        $this->route = [
            "POST" => [
                "/users/register" => [$this->controller, "register"],
                "/users/login" => [$this->controller, "login"],
                "/users/logout" => [$this->controller, "logout"],
                
                // Protect the /users/addresses route

                "/users/addresses" => function() {
                    $this->middleware->authenticated(); // Authenticate the user
                    $this->add->store();
                }
            ],
        ];

        $handleMethod = $_SERVER["REQUEST_METHOD"];
        $handleUrl = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        if (isset($this->route[$handleMethod][$handleUrl])) {
            call_user_func($this->route[$handleMethod][$handleUrl]);
            return;
        }

        http_response_code(404); // Not Found
        echo json_encode(["status" => false, "message" => "Endpoint not found"]);
    }
}
