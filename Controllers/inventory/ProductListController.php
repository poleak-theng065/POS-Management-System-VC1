<?php
require_once "Models/ProductModel.php";

class ProductListController extends BaseController {
<<<<<<< HEAD
    public function productList() {
=======

    public function product_list() {
>>>>>>> main
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

