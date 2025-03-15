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

// Dachboard 
$route->get("/", [DashboardController::class, 'dashboard']);

// Product List
$route->get("/product_list", [ProductListController::class, 'productList']);

// Import Product
$route->get("/import_product", [ImportProductController::class, 'importProduct']);

// Category List
$route->get("/category_list", [CategoryListController::class, 'categoryList']);

// Login
$route->get("/login", [LoginController::class, 'login']);

// Sold Product
$route->get("/sold_product", [SoldProductController::class, 'soldProduct']);

// Low Stock Product
$route->get("/low_stock_product", [LowStockProductController::class, 'lowStockProduct']);

// Run Out Of Stock Product
$route->get("/run_out_of_stock", [RunOutOfStockController::class, 'runOutOfStock']);

// Return Product
$route->get("/return_product", [ReturnProductController::class, 'returnProduct']);

// New Import Product
$route->get("/import_new_product", [ImportNewProductController::class, 'importNewProduct']);

// Order New Product
$route->get("/order_new_product", [OrderNewProductController::class, 'orderNewProduct']);
$route->get("/order_new_product/create", [OrderNewProductController::class, 'create']);
$route->post("/order_new_product/store", [OrderNewProductController::class, 'store']);
$route->get("/order_new_product/edit/{id}", [OrderNewProductController::class, 'edit']);
$route->put("/order_new_product/update/{id}", [OrderNewProductController::class, 'update']);
$route->get("/order_new_product/delete/{id}", [OrderNewProductController::class, 'delete']);

$route->route();