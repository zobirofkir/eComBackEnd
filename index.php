<?php

use Auth\Auth;
use Route\Routes;
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . "/vendor/autoload.php";


/*
    If You have create all db should be edit .env file and execute /migrations/db/Db.php file for execute this code  or visit this url http://127.0.0.1:8080/migrations/db/Db.php
*/

$route = new Routes();
$route->routes();