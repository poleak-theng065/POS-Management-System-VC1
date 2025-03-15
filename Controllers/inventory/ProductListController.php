<?php
require_once "Models/ProductModel.php";

class ProductListController extends BaseController {

    public function product_list() {
        $this->view('inventory/product_list/product_list');
    }

    private $iteam;
    public function __construct()
    {
        $this->iteam = new ProductModel();
    }

    public function index()
    {
        $products = $this->iteam->getProducts();
        $this->view("inventory/product_list/product_list", ["products" => $products]);
    }
    
    public function create()
    {
        $this->view("inventory/product_list/product_list");
    }

}

