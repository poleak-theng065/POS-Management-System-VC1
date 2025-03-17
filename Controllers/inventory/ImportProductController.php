<?php

require_once ("Models/inventory/OrderNewProductModel.php");

class ImportProductController extends BaseController {

    private $newOrders;

    public function __construct() {
        $this->newOrders = new OrderNewProductModel();
    }

    public function create() {
        $this->view('inventory/order_new_product/create');
    }

    public function store()
    {
        $productName = $_POST['productname'];
        $quantity = $_POST['quantity'];
        $orderDate = $_POST['orderdate'];
        $expectedDelivery = $_POST['expecteddelivery'];
        $supplier = $_POST['supplier'];
        $this->newOrders->addNewOrder($productName, $quantity, $orderDate, $expectedDelivery, $supplier);
        $this->redirect('/order_new_product');
    }



   
}

