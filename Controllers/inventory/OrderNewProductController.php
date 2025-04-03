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

        if (isset($_FILES['image']) && isset($_FILES['image']['name']) && isset($_FILES['image']['tmp_name'])) {
            $image = $_FILES['image']['name'];

            // Move the uploaded file to a specific directory
            move_uploaded_file($_FILES['image']['tmp_name'], "assets/img/upload/" . $image);
        } else {
            $image = null; // Handle the case where no image is uploaded
        }
        
        $this->newOrders->addNewOrder($productName, $barCode, $brand, $expectedDelivery, $orderDate, $status, 
        $category, $model, $supplier, $productStatus, $basePriceUSD, $basePriceKHR, $quantity, $exchangeRate, $totalPriceUSD , $totalPriceKHR, $image);
        $this->redirect('/order_new_product');
    }


    public function edit($id) {

        $result = $this->newOrders->getOrderNewProductById($id);
        $this->view("inventory/order_new_product/edit", ['newOrder' => $result]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productName = $_POST['productName'] ?? null;
            $barCode = $_POST['barcode'] ?? null;
            $brand = $_POST['brand'] ?? null;
            $expectedDelivery = $_POST['expectedDelivery'] ?? null;
            $orderDate = $_POST['orderDate'] ?? null;
            $status = $_POST['status'] ?? null;
            $category = $_POST['category'] ?? null;
            $model = $_POST['model'] ?? null;
            $supplier = $_POST['supplier'] ?? null;
            $productStatus = $_POST['productStatus'] ?? null;
            $basePriceUSD = $_POST['basePriceUSD'] ?? null;
            $basePriceKHR = $_POST['basePriceKHR'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $exchangeRate = $_POST['exchangeRate'] ?? null;
            $totalPriceUSD = $_POST['totalPriceUSD'] ?? null;
            $totalPriceKHR = $_POST['totalPriceKHR'] ?? null;

            // Handle image upload
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['name']) {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "assets/img/upload/" . $image);
            }

            // Call model function
            $this->newOrders->updateNewOrder(
                $id, $productName, $barCode, $brand, $expectedDelivery, $orderDate, $status,
                $category, $model, $supplier, $productStatus, $basePriceUSD, $basePriceKHR, 
                $quantity, $exchangeRate, $totalPriceUSD, $totalPriceKHR, $image
            );

            // Redirect after update
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


