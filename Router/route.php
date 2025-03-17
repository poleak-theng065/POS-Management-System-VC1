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
require_once "Controllers/inventory/ArrivedProductController.php";
require_once "Controllers/inventory/OrderNewProductController.php";


$route = new Router();

// category
$route->get("/category_list", [CategoryListController::class, 'index']);
$route->get("/inventory/category_list/create", [CategoryListController::class, 'create']);
$route->get('/inventory/category_list/edit/{id}', [CategoryListController::class, 'edit']);
$route->post('/inventory/category_list/update', [CategoryListController::class, 'update']);
$route->post('/inventory/category_list/store', [CategoryListController::class, 'store']);
$route->post('/inventory/category_list/destroy/{id}', [CategoryListController::class, 'destroy']);

// Product List
$route->get("/product_list", [ProductListController::class, 'index']); // This should be the main route for displaying products
$route->get("/inventory/product_list/create", [ProductListController::class, 'create']); // Route to create a new product
$route->get('/inventory/product_list/edit/{id}', [ProductListController::class, 'edit']); // Route to edit a specific product
$route->post('/inventory/product_list/update/{id}', [ProductListController::class, 'update']);
$route->post('/inventory/product_list/store', [ProductListController::class, 'store']); // Route to store a new product
$route->post('/inventory/product_list/destroy/{id}', [ProductListController::class, 'destroy']); // Route to delete a product

// Dachboard 
$route->get("/", [DashboardController::class, 'dashboard']);

// Import Product
$route->get("/import_product", [ImportProductController::class, 'create']);
$route->post("/import_product/store", [ImportProductController::class, 'store']);

// Login
$route->get("/login", [LoginController::class, 'login']);

// Sold Product
$route->get("/sold_product", [SoldProductController::class, 'soldProduct']);

// Low Stock Product
$route->get("/low_stock_product", [LowStockProductController::class, 'index']);

// Run Out Of Stock Product
$route->get("/run_out_of_stock", [RunOutOfStockController::class, 'runOutOfStock']);

// Return Product
$route->get("/return_product", [ReturnProductController::class, 'returnProduct']);
$route->get("/return_product/create", [ReturnProductController::class, 'create']);
$route->post("/return_product/store", [ReturnProductController::class, 'store']);
$route->get("/return_product/edit/{id}", [ReturnProductController::class, 'edit']);
$route->put("/return_product/update/{id}", [ReturnProductController::class, 'update']);
$route->delete("/return_product/delete/{id}", [ReturnProductController::class, 'delete']);

// New Import Product
$route->get("/arrived_product", [ArrivedProductController::class, 'arrivedProduct']);
$route->get("/arrived_product/edit/{id}", [ArrivedProductController::class, 'edit']);
$route->put("/arrived_product/update/{id}", [ArrivedProductController::class, 'update']);
$route->delete("/arrived_product/delete/{id}", [ArrivedProductController::class, 'delete']);

// Order New Product
$route->get("/order_new_product", [OrderNewProductController::class, 'orderNewProduct']);
$route->get("/order_new_product/create", [OrderNewProductController::class, 'create']);
$route->post("/order_new_product/store", [OrderNewProductController::class, 'store']);
$route->get("/order_new_product/edit/{id}", [OrderNewProductController::class, 'edit']);
$route->put("/order_new_product/update/{id}", [OrderNewProductController::class, 'update']);
$route->delete("/order_new_product/delete/{id}", [OrderNewProductController::class, 'delete']);

$route->route();
