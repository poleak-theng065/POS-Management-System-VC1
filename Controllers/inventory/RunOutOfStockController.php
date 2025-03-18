<?php

require_once ("Models/inventory/OutStockModel.php");
class RunOutOfStockController extends BaseController
{
    public function runOutOfStock()
    {
        $this->view('inventory/run_out_of_stock/run_out_of_stock');
    }

    private $iteam;
    public function __construct()
    {
        $this->iteam = new OutStockModel();
    }

    public function index()
    {
        $products = $this->iteam->getProducts();
        $categories = $this->iteam->getCategories();
        $this->view("inventory/run_out_of_stock/run_out_of_stock", ["products" => $products, "categories" => $categories]);
    }
}
