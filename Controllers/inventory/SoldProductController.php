<?php

require_once("Models/inventory/SoldProductModel.php");

class SoldProductController extends BaseController
{

    private $sales;

    public function __construct()
    {
        $this->sales = new SoldProductModel();  // Instantiate the SoldProductModel class
    }

    // This method is for showing the page with a list of sold products
    public function soldProduct()
    {
        $this->view('inventory/sold_product/sold_product');
    }

    // This method fetches products and sold items from the model and passes them to the view
    public function index()
    {
        // Fetch all products and sold items from the model
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();  // Fetch sold products using the getSaleItems() method

        // Pass data to the view
        $this->view("inventory/sold_product/sold_product", [
            "products" => $products,
            "saleItems" => $saleItems
        ]);
    }
}
