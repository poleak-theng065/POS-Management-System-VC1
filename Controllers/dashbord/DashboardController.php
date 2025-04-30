<?php
require_once "Models/dashbord/DashbordModel.php"; 
require_once "Controllers/BaseController.php"; 
require_once "Controllers/dashbord/TotalSoldController.php";
require_once "Controllers/dashbord/OrderStatisticsController.php";
require_once "Controllers/dashbord/TransactionsController.php";

class DashboardController extends BaseController
{
    private $sales;
    private $totalSoldController;
    private $orderStatisticsController;
    private $transactionsController;

    public function __construct()
    {
        $this->sales = new DashboardModel(); 
        $this->totalSoldController = new TotalSoldController();
        $this->orderStatisticsController = new OrderStatisticsController();
        $this->transactionsController = new TransactionsController();
    }

    public function dashboard()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalSoldData = $this->totalSoldController->getTotalSoldData();
        $orderStatisticsData = $this->orderStatisticsController->getOrderStatisticsData();
        $stockStatusData = $this->transactionsController->index();

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        error_log("DashboardController - Order Statistics Data: " . print_r($orderStatisticsData, true));
        error_log("DashboardController - Stock Status Data: " . print_r($stockStatusData, true));

        $data = [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalSoldData['totalProfit'],
            "totalExpenses" => $totalSoldData['totalExpenses'],
            "totalQuantitySold" => $totalQuantitySold,
            "categories" => $orderStatisticsData['categories'],
            "totalProducts" => $orderStatisticsData['totalProducts'],
            "low_stock_products" => $stockStatusData['low_stock_products'],
            "out_of_stock_products" => $stockStatusData['out_of_stock_products']
        ];

        // Debug: Log the final data array
        error_log("Final data array in DashboardController: " . print_r($data, true));

        $this->view("dashboard/dashboard", $data);
    }

    public function soldProduct()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalSoldData = $this->totalSoldController->getTotalSoldData();
        $orderStatisticsData = $this->orderStatisticsController->getOrderStatisticsData();

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        $this->view("dashboard/dashboard", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalSoldData['totalProfit'],
            "totalExpenses" => $totalSoldData['totalExpenses'],
            "totalQuantitySold" => $totalQuantitySold,
            "categories" => $orderStatisticsData['categories'],
            "totalProducts" => $orderStatisticsData['totalProducts']
        ]);
    }

    public function index()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalSoldData = $this->totalSoldController->getTotalSoldData();
        $orderStatisticsData = $this->orderStatisticsController->getOrderStatisticsData();

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        error_log("Total Profit in DashboardController: " . $totalSoldData['totalProfit']);
        error_log("Total Expenses in DashboardController: " . $totalSoldData['totalExpenses']);
        error_log("Order Statistics Data in DashboardController: " . print_r($orderStatisticsData, true));

        if ($products === false || $saleItems === false) {
            error_log("Failed to fetch data in DashboardController::index");
            $products = $products === false ? [] : $products;
            $saleItems = $saleItems === false ? [] : $saleItems;
        }

        $this->view("dashboard/dashboard", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalSoldData['totalProfit'],
            "totalExpenses" => $totalSoldData['totalExpenses'],
            "totalQuantitySold" => $totalQuantitySold,
            "categories" => $orderStatisticsData['categories'],
            "totalProducts" => $orderStatisticsData['totalProducts']
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