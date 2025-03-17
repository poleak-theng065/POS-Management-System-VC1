<?php
require_once "Models/LowStockProductModel.php";

class LowStockProductController extends BaseController
{
    public function lowStockProduct()
    {
        $this->view('inventory/low_stock_product/low_stock_product');
    }

    private $iteam;
    public function __construct()
    {
        $this->iteam = new LowStockProductModel();
    }

    public function index()
    {
        $products = $this->iteam->getProducts();
        $categories = $this->iteam->getCategories();
        $this->view("inventory/low_stock_product/low_stock_product", ["products" => $products, "categories" => $categories]);
    }
}
