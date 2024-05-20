<?php
use database\Addresses;
use database\Categories;
use database\OrderItems;
use database\Orders;
use database\ProductImages;
use database\Products;
use database\Reviews;
use database\Users;

require_once __DIR__ . "/../../vendor/autoload.php";

/*
    Create Addresses Table
*/

$addresses = new Addresses();
$addresses->create();


/*
    Create Categories Table
*/

$categories = new Categories();
$categories->create();

/*
    Create Order_Items Table
*/

$order_items = new OrderItems();
$order_items->create();


/*
    Create oders table
*/

$orders = new Orders();
$orders->create();


/*
    Create Product Images table
*/

$images = new ProductImages();
$images->create();


/*
    Create Products Table
*/

$products = new Products();
$products->create();


/*
    Create Reviews Table
*/

$reviews = new Reviews();
$reviews->create();


/*
    Create Users Table
*/

$users = new Users();
$users->create();
