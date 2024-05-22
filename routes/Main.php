<?php
namespace Route;

use Controller\AddressController;
use Controller\AuthController;
use Controller\CategorieController;
use Middleware\Middleware;

class Main 
{
    protected $route;
    protected $controller;
    protected $add;
    protected $middleware;
    protected $categorie;

    public function __construct()
    {
        $this->controller = new AuthController();
        $this->add = new AddressController();
        $this->middleware = new Middleware();
        $this->categorie = new CategorieController();
    }

    public function handleRoutes()
    {
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