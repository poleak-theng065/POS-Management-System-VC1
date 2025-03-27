<?php
require_once("Models/inventory/SaleFormModel.php");
require_once("Models/inventory/SoldProductModel.php"); // Add this line

class SoldProductController extends BaseController {
    private $sales;

    public function __construct()
    {
        $this->sales = new SoldProductModel();
    }

    public function soldProduct() {
        $this->view('inventory/sold_product/sold_product');
    }

    public function index()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSolds();
        $this->view("inventory/sold_product/sold_product", [
            "products" => $products,
            "saleItems" => $saleItems
        ]);
    }
}
