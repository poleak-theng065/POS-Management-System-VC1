<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/inventory/ProductListController.php";
require_once "Controllers/inventory/DashboardController.php";
require_once "Controllers/inventory/ImportProductController.php";
require_once "Controllers/inventory/CategoryListController.php";
require_once "Controllers/inventory/LoginController.php";


$route = new Router();


require_once "Controllers/CategoryController.php";

// category
$route->get("/category", [CategoryController::class, 'index']);
$route->get("/category/create", [CategoryController::class, 'create']);

// Dachboard 
$route->get("/", [DashboardController::class, 'dashboard']);

// Product List
$route->get("/product_list", [ProductListController::class, 'product_list']);

// Import Product
$route->get("/import_product", [ImportProductController::class, 'import_product']);

// Category List
$route->get("/category_list", [CategoryListController::class, 'category_list']);

// Login
$route->get("/login", [LoginController::class, 'login']);



$route->route();