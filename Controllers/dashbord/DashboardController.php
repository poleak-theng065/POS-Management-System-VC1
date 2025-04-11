<?php
require_once "Models/dashbord/DashbordModel.php"; 
require_once "Controllers/BaseController.php"; 
require_once "Controllers/dashbord/TotalSoldController.php"; // Add this line

class DashboardController extends BaseController
{
    private $sales;
    private $totalSoldController;

    public function __construct()
    {
        $this->sales = new DashboardModel(); 
        $this->totalSoldController = new TotalSoldController(); // Initialize TotalSoldController
    }

    public function dashboard()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalSoldData = $this->totalSoldController->getTotalSoldData(); // Fetch data from TotalSoldController

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        $this->view("dashboard/dashboard", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalSoldData['totalProfit'], // Use TotalSoldController data
            "totalCostPrice" => $totalSoldData['totalCostPrice'], // Use TotalSoldController data
            "totalQuantitySold" => $totalQuantitySold
        ]);
    }

    public function soldProduct()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalSoldData = $this->totalSoldController->getTotalSoldData(); // Fetch data from TotalSoldController

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        $this->view("dashboard/dashboard", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalSoldData['totalProfit'], // Use TotalSoldController data
            "totalCostPrice" => $totalSoldData['totalCostPrice'], // Use TotalSoldController data
            "totalQuantitySold" => $totalQuantitySold
        ]);
    }

    public function index()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalSoldData = $this->totalSoldController->getTotalSoldData(); // Fetch data from TotalSoldController

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        // Log for debugging
        error_log("Total Profit in DashboardController: " . $totalSoldData['totalProfit']);
        error_log("Total Cost Price in DashboardController: " . $totalSoldData['totalCostPrice']);

        if ($products === false || $saleItems === false) {
            error_log("Failed to fetch data in DashboardController::index");
            $products = $products === false ? [] : $products;
            $saleItems = $saleItems === false ? [] : $saleItems;
        }

        $this->view("dashboard/dashboard", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalSoldData['totalProfit'], // Use TotalSoldController data
            "totalCostPrice" => $totalSoldData['totalCostPrice'], // Use TotalSoldController data
            "totalQuantitySold" => $totalQuantitySold
        ]);
    }

    public function getUnitPrice($barcode)
    {
        $unitPrice = $this->sales->getUnitPriceByBarcode($barcode);
        if ($unitPrice !== null) {
            echo json_encode(['success' => true, 'unit_price' => $unitPrice]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Unit price not found']);
        }
    }
}