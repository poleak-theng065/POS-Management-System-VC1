<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
require_once "Database/Database.php";
require_once "Controllers/inventory/ProductListController.php";
require_once "Controllers/inventory/DashboardController.php";
require_once "Controllers/inventory/ImportProductController.php";
require_once "Controllers/inventory/CategoryListController.php";
require_once "Controllers/inventory/LoginController.php";
require_once "Controllers/inventory/SoldProductController.php";
require_once "Controllers/inventory/LowStockProductController.php";
require_once "Controllers/inventory/RunOutOfStockController.php";
require_once "Controllers/inventory/ReturnProductController.php";
require_once "Controllers/inventory/ImportNewProductController.php";
require_once "Controllers/inventory/OrderNewProductController.php";


$route = new Router();

// category
$route->get("/category_list", [CategoryListController::class, 'index']);
$route->get("/inventory/category_list/create", [CategoryListController::class, 'create']);
$route->get('/inventory/category_list/edit/{id}', [CategoryListController::class, 'edit']);
$route->post('/inventory/category_list/update', [CategoryListController::class, 'update']);
$route->post('/inventory/category_list/store',[CategoryListController::class, 'store']);
$route->post('/inventory/category_list/destroy/{id}', [CategoryListController::class, 'destroy']);

// Product List
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/inventory/category_list/create", [CategoryListController::class, 'create']);

// Dachboard 
$route->get("/", [DashboardController::class, 'dashboard']);

// Import Product
$route->get("/import_product", [ImportProductController::class, 'import_product']);

// Login
$route->get("/login", [LoginController::class, 'login']);

// Sold Product
$route->get("/sold_product", [SoldProductController::class, 'sold_product']);

// Low Stock Product
$route->get("/low_stock_product", [LowStockProductController::class, 'low_stock_product']);

// Run Out Of Stock Product
$route->get("/run_out_of_stock", [RunOutOfStockController::class, 'run_out_of_stock']);

// Return Product
$route->get("/return_product", [ReturnProductController::class, 'return_product']);

// New Import Product
$route->get("/import_new_product", [ImportNewProductController::class, 'import_new_product']);

// Order New Product
$route->get("/order_new_product", [OrderNewProductController::class, 'order_new_product']);

$route->route();