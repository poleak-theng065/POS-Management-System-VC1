<?php

require_once("Models/inventory/SoldProductModel.php");

class SoldProductController extends BaseController
{
    private $sales;

    public function __construct()
    {
        $this->sales = new SoldProductModel();  // Instantiate the SoldProductModel class
    }

    // This method is for showing the page with a list of sold products (without data)
    public function soldProduct()
    {
        $this->view('inventory/sold_product/sold_product');
    }

    // This method fetches products and sold items from the model and passes them to the view
    public function index()
    {
        // Get the products and sale items from the model
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $totalProfit = $this->sales->getTotalProfitForCurrentMonth();

        // Calculate total quantity of all sold products (sum across all sale items)
        $totalQuantitySold = 0;
        foreach ($saleItems as $saleItem) {
            $totalQuantitySold += $saleItem['quantity'];  // Summing the quantity of each sale item
        }

        // Handle errors when fetching products or sale items
        if ($products === false || $saleItems === false) {
            error_log("Failed to fetch data in SoldProductController::index");
            $products = $products === false ? [] : $products;
            $saleItems = $saleItems === false ? [] : $saleItems;
        }

        // Pass the necessary data to the view
        $this->view("inventory/sold_product/sold_product", [
            "products" => $products,
            "saleItems" => $saleItems,
            "totalProfit" => $totalProfit,
            "totalQuantitySold" => $totalQuantitySold  // Pass total quantity to the view
        ]);
    }

    // Fetch unit price by barcode via AJAX
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
