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

// category
$route->get("/category_list", [CategoryListController::class, 'index']);
$route->get("/category/create", [CategoryListController::class, 'create']);
$route->get('/category/edit/{id}', [CategoryListController::class, 'edit']);

// $routes->post('/category_list/store',[CategoryListController::class, 'store']);
// $routes->get('/category/edit',[CategoryListController::class, 'edit']);
// $routes->put('/category_list/update',[CategoryListController::class, 'update']);
// $routes->delete('/category/delete',[CategoryListController::class, 'destroy']);

// Dachboard 
$route->get("/", [DashboardController::class, 'dashboard']);

// Product List
$route->get("/product_list", [ProductListController::class, 'product_list']);

// Import Product
$route->get("/import_product", [ImportProductController::class, 'import_product']);

// Login
$route->get("/login", [LoginController::class, 'login']);



$route->route();