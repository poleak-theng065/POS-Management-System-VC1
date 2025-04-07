<?php
require_once "Models/dashbord/TotalSoldModel.php";

class TotalSoldController extends BaseController
{
    private $sales;

    public function __construct()
    {
        $this->sales = new TotalSoldModel();
    }

    public function soldProduct()
    {
        $this->view('dashbord/dashboard_component/_totalSold');
    }

    public function index()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalProfit = $this->sales->getTotalProfitForCurrentMonth();
        $totalCostPrice = $this->sales->getTotalCostPriceForCurrentMonth();

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        if ($products === false || $saleItems === false) {
            error_log("Failed to fetch data in TotalSoldController::index");
            $products = $products === false ? [] : $products;
            $saleItems = $saleItems === false ? [] : $saleItems;
        }

        error_log("Total Profit in index(): " . $totalProfit);
        error_log("Total Cost Price in index(): " . $totalCostPrice);

        $this->view("dashbord/dashboard_component/_totalSold", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalProfit,
            "totalCostPrice" => $totalCostPrice,
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