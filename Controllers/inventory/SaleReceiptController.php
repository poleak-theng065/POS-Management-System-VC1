<?php

require_once("Models/inventory/SaleReceiptModel.php");

class SaleReceiptController extends BaseController
{
    private $newOrders;

    public function __construct()
    {
        $this->newOrders = new SaleReceiptModel();
    }

    public function orderNewProduct()
    {
        $result = $this->newOrders->getOrderNewProduct();

    // Ensure the result is always an array
        if (!is_array($result)) {
            $result = []; // Set an empty array if null
        }

    // Debugging to check if data is available
        if (empty($result)) {
            error_log("Warning: No sale receipt data found.");
        }

    // Check if the view file exists
        $viewPath = 'inventory/sale_receipt/sale_receipt';
        if (!file_exists("views/$viewPath.php")) {
         die("Error: View file '$viewPath.php' not found.");
        }

        $this->view($viewPath, ['saleReceipt' => $result]); // Pass the corrected data
    }


    public function store()
    {
        // Ensure request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Invalid request method.");
        }

        // Sanitize and retrieve input data
        $productName = $_POST['productname'] ?? null;
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

        $this->newOrders->addNewOrder(
            $productName,
            $barCode,
            $brand,
            $expectedDelivery,
            $orderDate,
            $status,
            $category,
            $model,
            $supplier,
            $productStatus,
            $basePriceUSD,
            $basePriceKHR,
            $quantity,
            $exchangeRate,
            $totalPriceUSD,
            $totalPriceKHR
        );

        $this->redirect('/sale_receipt');
    }

    public function edit($id)
    {
        $result = $this->newOrders->getOrderNewProductById($id);
        if (!$result) {
            die("Error: Sale receipt not found.");
        }

        $this->view("inventory/sale_receipt/edit", ['saleReceipt' => $result]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Invalid request method.");
        }

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

        $this->newOrders->updateNewOrder(
            $id,
            $productName,
            $barCode,
            $brand,
            $expectedDelivery,
            $orderDate,
            $status,
            $category,
            $model,
            $supplier,
            $productStatus,
            $basePriceUSD,
            $basePriceKHR,
            $quantity,
            $exchangeRate,
            $totalPriceUSD,
            $totalPriceKHR
        );

        $this->redirect('/sale_receipt');
    }

    public function delete($id)
    {
        if (!$this->newOrders->deleteOrderNew($id)) {
            die("Error: Failed to delete the sale receipt.");
        }

        $this->redirect('/sale_receipt');
    }
}
