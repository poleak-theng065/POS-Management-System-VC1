<?php

// Core Dependencies
require_once "Router.php";
require_once "Controllers/BaseController.php";

// Database Dependency
require_once "Database/Database.php";

// Dashboard Controller
require_once "Controllers/DashboardController.php";

// Inventory Controllers
require_once "Controllers/inventory/ProductListController.php";
require_once "Controllers/inventory/CategoryListController.php";
require_once "Controllers/inventory/SoldProductController.php";
require_once "Controllers/inventory/LowStockProductController.php";
require_once "Controllers/inventory/RunOutOfStockController.php";
require_once "Controllers/inventory/ReturnProductController.php";
require_once "Controllers/inventory/ArrivedProductController.php";
require_once "Controllers/inventory/OrderNewProductController.php";
require_once "Controllers/inventory/SaleFormController.php";
require_once "Controllers/inventory/SaleReceiptController.php";

// Authentication Controllers
require_once "Controllers/auth/LoginController.php";
require_once "Controllers/auth/CreateAccountController.php";
require_once "Controllers/auth/UserAccountController.php";



$route = new Router();

/**
 * Authentication Routes
 */
$route->get("/login", [AuthController::class, 'login']);
$route->post("/login/submit", [AuthController::class, 'authenticate']);
$route->get("/logout", [AuthController::class, 'logout']);
$route->get("/forgot-password", [AuthController::class, 'forgotPassword']);

/**
 * User Account Routes
 */
$route->get("/create_account", [CreateAccountController::class, 'create_account']);
$route->get("/user_account", [UserAccountController::class, 'user_account']);
// routes.php or your route configuration file
$route->post("/create-account/store", [CreateAccountController::class, 'store']);
// Update user account (edit form submission)
$route->post("/user-account/update", [UserAccountController::class, 'update']); 
// Delete user account
$route->post("/user-account/delete", [UserAccountController::class, 'delete']);


/**
 * Dashboard Routes
 */
$route->get("/", [DashboardController::class, 'dashboard']);

/**
 * Category Routes
 */
$route->get("/category_list", [CategoryListController::class, 'index']);
$route->get("/category_list/create", [CategoryListController::class, 'create']);
$route->get('/category_list/edit/{id}', [CategoryListController::class, 'edit']);
$route->post('/category_list/update', [CategoryListController::class, 'update']);
$route->post('/category_list/store', [CategoryListController::class, 'store']);
$route->post('/category_list/destroy/{id}', [CategoryListController::class, 'destroy']);

/**
 * Product List Routes
 */
$route->get("/product_list", [ProductListController::class, 'index']);
$route->get("/product_list/create", [ProductListController::class, 'create']);
$route->get("/product_list/edit/{id}", [ProductListController::class, 'edit']);
$route->post("/product_list/update/{id}", [ProductListController::class, 'update']);
$route->post("/product_list/store", [ProductListController::class, 'store']);
$route->get("/product_list/destroy/{id}", [ProductListController::class, 'destroy']);

/**
 * Sold Product Routes
 */
$route->get("/sold_product", [SoldProductController::class, 'index']);

/**
 * Low Stock Product Routes
 */
$route->get("/low_stock_product", [LowStockProductController::class, 'index']);

/**
 * Run Out of Stock Routes
 */
$route->get("/run_out_of_stock", [RunOutOfStockController::class, 'index']);
$route->get("/run_out_and_low_stock_product", [RunOutAndLowStockProductController::class, 'runOutAndLowStockProduct']);

/**
 * Return Product Routes
 */
$route->get("/return_product", [ReturnProductController::class, 'returnProduct']);
$route->get("/return_product/create", [ReturnProductController::class, 'create']);
$route->post("/return_product/store", [ReturnProductController::class, 'store']);
$route->get("/return_product/edit/{id}", [ReturnProductController::class, 'edit']);
$route->put("/return_product/update/{id}", [ReturnProductController::class, 'update']);
$route->delete("/return_product/delete/{id}", [ReturnProductController::class, 'delete']);
$route->post("/return_product/upload", [ReturnProductController::class, 'upload']);

/**
 * Arrived Product Routes
 */
$route->get("/arrived_product", [ArrivedProductController::class, 'arrivedProduct']);
$route->get("/arrived_product/edit/{id}", [ArrivedProductController::class, 'edit']);
$route->put("/arrived_product/update/{id}", [ArrivedProductController::class, 'update']);
$route->delete("/arrived_product/delete/{id}", [ArrivedProductController::class, 'delete']);

/**
 * Sale Receipt Routes
 */
$route->get("/sale_receipt", [SaleReceiptController::class, 'orderNewProduct']);
$route->get("/sale_receipt/create", [SaleReceiptController::class, 'create']);
$route->post("/sale_receipt/store", [SaleReceiptController::class, 'store']);
$route->get("/sale_receipt/edit/{id}", [SaleReceiptController::class, 'edit']);
$route->put("/sale_receipt/update/{id}", [SaleReceiptController::class, 'update']);
$route->delete("/sale_receipt/delete/{id}", [SaleReceiptController::class, 'delete']);

/**
 * Order New Product Routes
 */
$route->get("/order_new_product", [OrderNewProductController::class, 'orderNewProduct']);
$route->get("/order_new_product/create", [OrderNewProductController::class, 'create']);
$route->post("/order_new_product/store", [OrderNewProductController::class, 'store']);
$route->get("/order_new_product/edit/{id}", [OrderNewProductController::class, 'edit']);
$route->put("/order_new_product/update/{id}", [OrderNewProductController::class, 'update']);
$route->delete("/order_new_product/delete/{id}", [OrderNewProductController::class, 'delete']);

/**
 * Sale Form Routes
 */
$route->get("/sale_form", [SaleFormController::class, 'index']);
$route->get("/sale_form/create", [SaleFormController::class, 'create']);
$route->post("/sale_form/store", [SaleFormController::class, 'store']);

// Execute the routing
$route->route();
