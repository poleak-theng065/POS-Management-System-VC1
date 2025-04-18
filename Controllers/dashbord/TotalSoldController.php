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
        $totalCostPrice = $this->totalSoldModel->getTotalCostPriceForCurrentMonth();

        // Log for debugging
        error_log("Total Quantity Sold in TotalSoldController: " . $totalQuantitySold);
        error_log("Total Profit in TotalSoldController: " . $totalProfit);
        error_log("Total Cost Price in TotalSoldController: " . $totalCostPrice);

        return [
            "totalQuantitySold" => $totalQuantitySold,
            "totalProfit" => $totalProfit,
            "totalCostPrice" => $totalCostPrice
        ];
    }

    public function index()
    {
        $data = $this->getTotalSoldData();
        $this->view("dashboard/dashboard_component/_totalSold", $data);
    }
}
