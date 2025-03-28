<?php

require_once "Router.php";
require_once "Controllers/BaseController.php";

// Dashboard  Require
require_once "Controllers/DashboardController.php";
// Database Require
require_once "Database/Database.php";

// Inventory Require
require_once "Controllers/inventory/ProductListController.php";
require_once "Controllers/inventory/CategoryListController.php";
require_once "Controllers/inventory/CreateAccountController.php";
require_once "Controllers/inventory/UserAccountController.php";
require_once "Controllers/inventory/SoldProductController.php";
require_once "Controllers/inventory/LowStockProductController.php";
require_once "Controllers/inventory/RunOutOfStockController.php";
require_once "Controllers/inventory/ReturnProductController.php";
require_once "Controllers/inventory/ArrivedProductController.php";
require_once "Controllers/inventory/OrderNewProductController.php";
require_once "Controllers/inventory/SaleFormController.php";

// Auth Require 
require_once "Controllers/auth/LoginController.php";

$route = new Router();

// category
$route->get("/category_list", [CategoryListController::class, 'index']);
$route->get("/category_list/create", [CategoryListController::class, 'create']);
$route->get('/category_list/edit/{id}', [CategoryListController::class, 'edit']);
$route->post('/category_list/update', [CategoryListController::class, 'update']);
$route->post('/category_list/store', [CategoryListController::class, 'store']);
$route->post('/category_list/destroy/{id}', [CategoryListController::class, 'destroy']);

// Product List
$route->get("/product_list", [ProductListController::class, 'index']); 
$route->get("/product_list/create", [ProductListController::class, 'create']); 
$route->get("/product_list/edit/{id}", [ProductListController::class, 'edit']); 
$route->post("/product_list/update/{id}", [ProductListController::class, 'update']);
$route->post("/product_list/store", [ProductListController::class, 'store']); 
$route->get("/product_list/destroy/{id}", [ProductListController::class, 'destroy']);


// Dachboard 
// $route->get("/", [DashboardController::class, 'dashboard']);


// Login
$route->get("/login", [AuthController::class, 'login']);
$route->post("/login/submit", [AuthController::class, 'authenticate']);
$route->get("/logout", [AuthController::class, 'logout']);

//create account
$route->get("/create_account", [CreateAccountController::class, 'create_account']);
//user account
$route->get("/user_account", [UserAccountController::class, 'user_account']);

// Sold Product
$route->get("/sold_product", [SoldProductController::class, 'index']);

// Low Stock Product
$route->get("/low_stock_product", [LowStockProductController::class, 'index']);

// Run Out Of Stock Product
$route->get("/run_out_of_stock", [RunOutOfStockController::class, 'index']);


// Run out of stock and low stock product
$route->get("/run_out_and_low_stock_product", [RunOutAndLowStockProductController::class, 'runOutAndLowStockProduct']);


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

// Sale form
$route->get("/sale_form", [SaleFormController::class, 'index']);
$route->get("/sale_form/create", [SaleFormController::class, 'create']);
$route->post("/sale_form/store", [SaleFormController::class, 'store']);

$route->route();
