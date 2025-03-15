<?php

require_once ("Models/inventory/ReturnProductModel.php");

class ReturnProductController extends BaseController {

    private $returnProducts;

    public function __construct() {
        $this->returnProducts = new ReturnProductModel();
    }

    public function returnProduct() {
        $result = $this->returnProducts->getReturnProduct();
        $this->view('inventory/return_product/return_product', ['returnProducts' => $result]);
    }

    public function create() {
        $this->view('inventory/return_product/create');
    }

    public function store()
    {
        $productName = $_POST['productname'];
        $quantity = $_POST['quantity'];
        $orderDate = $_POST['orderdate'];
        $expectedDelivery = $_POST['expecteddelivery'];
        $supplier = $_POST['supplier'];
        $this->returnProducts->addNewReturnProduct($productName, $quantity, $orderDate, $expectedDelivery, $supplier);
        $this->redirect('/return_product');
    }


    public function edit($id) {

        $result = $this->returnProducts->getReturnProductById($id);
        $this->view("inventory/return_product/edit", ['newOrder' => $result]);
    }

    public function update($id)
    {
        $productName = $_POST['productname'];
        $quantity = $_POST['quantity'];
        $orderDate = $_POST['orderdate'];
        $expectedDelivery = $_POST['expecteddelivery'];
        $supplier = $_POST['supplier'];
        $this->returnProducts->updateReturnProduct($productName, $quantity, $orderDate, $expectedDelivery, $supplier, $id);
        $this->redirect('/return_product');
    }

    public function delete($id)
    {
        $this->newOrders->deleteReturnProduct($id);
        $this->redirect('/return_product');
    }

   
}

