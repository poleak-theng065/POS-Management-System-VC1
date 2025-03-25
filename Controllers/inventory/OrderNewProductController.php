<?php

require_once ("Models/inventory/OrderNewProductModel.php");

class OrderNewProductController extends BaseController {

    private $newOrders;

    public function __construct() {
        $this->newOrders = new OrderNewProductModel();
    }

    public function orderNewProduct() {
        $result = $this->newOrders->getOrderNewProduct();
        $this->view('inventory/order_new_product/order_new_product', ['newOrders' => $result]);
    }

    public function create() {
        $this->view('inventory/order_new_product/create');
    }

    public function store()
    {
        // Product information
        $productName = $_POST['productname'];
        $barCode = $_POST['barcode'];
        $brand = $_POST['brand'];
        $expectedDelivery = $_POST['expectedDelivery'];
        $orderDate = $_POST['orderDate'];
        $status = $_POST['status'];
        
        // Organization
        $category = $_POST['category'];
        $model = $_POST['model'];
        $supplier = $_POST['supplier'];
        $productStatus = $_POST['productStatus'];

        // Pricing
        $basePriceUSD = $_POST['basePriceUSD'];
        $basePriceKHR = $_POST['basePriceKHR'];
        $quantity = $_POST['quantity'];
        $exchangeRate = $_POST['exchangeRate'];
        $totalPriceUSD = $_POST['totalPriceUSD'];
        $totalPriceKHR = $_POST['totalPriceKHR'];
        
        $this->newOrders->addNewOrder($productName, $barCode, $brand, $expectedDelivery, $orderDate, $status, 
        $category, $model, $supplier, $productStatus, $basePriceUSD, $basePriceKHR, $quantity, $exchangeRate, $totalPriceUSD , $totalPriceKHR);
        $this->redirect('/order_new_product');
    }


    public function edit($id) {

        $result = $this->newOrders->getOrderNewProductById($id);
        $this->view("inventory/order_new_product/edit", ['newOrder' => $result]);
    }

    public function update($id)
    {
        // Ensure data is posted before accessing
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Product information
            $productName = $_POST['productname'] ?? null;
            $barCode = $_POST['barcode'] ?? null;
            $brand = $_POST['brand'] ?? null;
            $orderDate = $_POST['orderDate'] ?? null;
            $expectedDelivery = $_POST['expecteddelivery'] ?? null;
            $productStatus = $_POST['productStatus'] ?? null;

            // Organization
            $category = $_POST['category'] ?? null;
            $model = $_POST['model'] ?? null;
            $supplier = $_POST['vendor'] ?? null;
            $status = $_POST['status'] ?? null;

            // Pricing
            $basePriceUSD = $_POST['basePriceUSD'] ?? null;
            $basePriceKHR = $_POST['basePriceKHR'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $exchangeRate = $_POST['exchangeRate'] ?? null;
            $totalPriceUSD = $_POST['totalPriceUSD'] ?? null;
            $totalPriceKHR = $_POST['totalPriceKHR'] ?? null;

            // Validate the required fields (you can add more validation as needed)
            if (!$productName || !$barCode || !$brand || !$orderDate || !$category || !$model || !$status) {
                echo "Please fill in all required fields.";
                return;
            }

            // Call model to update the database
            $this->newOrders->updateNewOrder(
                $id,
                $barCode,
                $brand,
                $orderDate,
                $expectedDelivery,
                $productStatus,
                $category,
                $model,
                $supplier,
                $status,
                $basePriceUSD,
                $basePriceKHR,
                $quantity,
                $exchangeRate,
                $totalPriceUSD,
                $totalPriceKHR
            );

            // Redirect after the update
            $this->redirect('/order_new_product');
        } else {
            echo "Invalid request method.";
        }
    }



    public function delete($id)
    {
        $this->newOrders->deleteOrderNew($id);
        $this->redirect('/order_new_product');
    }

   
}

