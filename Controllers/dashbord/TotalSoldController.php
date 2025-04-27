<?php
require_once "Controllers/BaseController.php";
require_once "Models/dashbord/TotalSoldModel.php";

class TotalSoldController extends BaseController
{
    private $totalSoldModel;

    public function __construct()
    {
        $this->totalSoldModel = new TotalSoldModel();
    }

    public function getTotalSoldData()
    {
        $totalQuantitySold = $this->totalSoldModel->getTotalQuantitySold();
        $totalProfit = $this->totalSoldModel->getTotalProfitForCurrentMonth();
        $totalExpenses = $this->totalSoldModel->getTotalCostPriceForCurrentMonth();

        // Log for debugging
        error_log("Total Quantity Sold in TotalSoldController: " . $totalQuantitySold);
        error_log("Total Profit in TotalSoldController: " . $totalProfit);
        error_log("Total Expenses in TotalSoldController: " . $totalExpenses);

        return [
            "totalQuantitySold" => $totalQuantitySold,
            "totalProfit" => $totalProfit,
            "totalExpenses" => $totalExpenses
        ];
    }

    public function index()
    {
        $data = $this->getTotalSoldData();
        $this->view("dashboard/dashboard_component/_totalSold", $data);
    }

    public function getUpdatedData()
    {
        $data = $this->getTotalSoldData();
        $response = [
            'success' => true,
            'totalProfit' => $data['totalProfit'],
            'totalExpenses' => $data['totalExpenses']
        ];

        error_log("getUpdatedData Response: " . print_r($response, true));
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}