<?php
namespace Route;

use Controller\AuthController;
use Controller\AddressController;
use Middleware\Middleware;

class Routes extends Main
{
    public function routes()
    { 
        $this->route = [
            "GET" => [
                "/users" => [$this->controller, "index"],

                /*
                    Authenticated Routes
                */

                "/users/addresses" => function()
                {
                    $this->middleware->authenticated();
                    $this->add->all();
                }
            ],

            "POST" => [
                "/users/register" => [$this->controller, "register"],
                "/users/login" => [$this->controller, "login"],
                "/users/logout" => [$this->controller, "logout"],

                /*
                    Authenticated Routes
                */
                
                "/users/addresses" => function() {
                    $this->middleware->authenticated(); 
                    $this->add->store();
                },
            ]
        ];

        $this->handleRoutes();
    }
}
