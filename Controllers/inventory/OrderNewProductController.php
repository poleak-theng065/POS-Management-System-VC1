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
            $productName = $_POST['productName'] ?? null;
            $barCode = $_POST['barcode'] ?? null;
            $brand = $_POST['brand'] ?? null;
            $orderDate = $_POST['orderDate'] ?? null;
            $expectedDelivery = $_POST['expectedDelivery'] ?? null;
            $status = $_POST['status'] ?? null;

            // Organization
            $category = $_POST['category'] ?? null;
            $model = $_POST['model'] ?? null;
            $supplier = $_POST['supplier'] ?? null;
            $productStatus = $_POST['productStatus'] ?? null;

            // Pricing
            $basePriceUSD = $_POST['basePriceUSD'] ?? null;
            $basePriceKHR = $_POST['basePriceKHR'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $exchangeRate = $_POST['exchangeRate'] ?? null;
            $totalPriceUSD = $_POST['totalPriceUSD'] ?? null;
            $totalPriceKHR = $_POST['totalPriceKHR'] ?? null;

            // Call model to update the database
            $this->newOrders->updateNewOrder(
                $id,
                $productName,
                $barCode,
                $brand,
                $orderDate,
                $expectedDelivery,
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

   
    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
                $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
                $fileName = $_FILES['fileUpload']['name'];
                $fileSize = $_FILES['fileUpload']['size'];
                $fileType = $_FILES['fileUpload']['type'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                // Allowed file types
                $allowedExtensions = ['xls', 'xlsx'];
    
                if (in_array($fileExtension, $allowedExtensions)) {
                    // Ensure upload directory exists
                    $uploadDir = 'uploads/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
    
                    $destination = $uploadDir . $fileName;
    
                    if (move_uploaded_file($fileTmpPath, $destination)) {
                        echo 'File uploaded successfully!';
    
                        require 'vendor/autoload.php'; // Ensure PhpSpreadsheet is installed
    
                        // Process the Excel file
                        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($destination);
                        $sheet = $spreadsheet->getActiveSheet();
                        $rows = $sheet->toArray();
    
                        foreach ($rows as $row) {
                            // Insert data into the database
                            $this->newOrders->addNewOrder(
                                $row[0], $row[1], $row[2], $row[3], $row[4], $row[5],
                                $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], 
                                $row[12], $row[13], $row[14], $row[15]
                            );
                        }
    
                        // Redirect after success
                        header("Location: /order_new_product");
                        exit();
                    } else {
                        echo 'Error moving the uploaded file!';
                    }
                } else {
                    echo 'Invalid file type! Only .xls and .xlsx files are allowed.';
                }
            } else {
                echo 'No file uploaded or an error occurred!';
            }
        } else {
            echo 'Invalid request!';
        }
    }
    
    

   
}


