<?php
require_once("Models/inventory/SoldProductModel.php");

class SoldProductController extends BaseController
{
    private $sales;

    public function __construct()
    {
        $this->sales = new SoldProductModel();
    }

    public function soldProduct()
    {
        $this->view('inventory/sold_product/sold_product');
    }

    public function index()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalProfit = $this->sales->getTotalProfit();

        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];
        }

        if ($products === false || $saleItems === false) {
            error_log("Failed to fetch data in SoldProductController::index");
            $products = $products === false ? [] : $products;
            $saleItems = $saleItems === false ? [] : $saleItems;
        }

        $this->view("inventory/sold_product/sold_product", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalProfit,
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