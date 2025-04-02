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
        // Fetch all products and sold items from the model
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();  // Fetch sold products including image_path

        // Check if data retrieval was successful
        if ($products === false || $saleItems === false) {
            // Log error or handle it as needed
            error_log("Failed to fetch data in SoldProductController::index");
            $products = $products === false ? [] : $products;
            $saleItems = $saleItems === false ? [] : $saleItems;
        }

        // Pass data to the view
        $this->view("inventory/sold_product/sold_product", [
            "products" => $products,
            "saleItems" => $saleItems
        ]);
    }

    // Optional: Method to get unit price by barcode (if needed in the view)
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