<?php

require_once ("Models/inventory/ArrivedProductModel.php");

class ArrivedProductController extends BaseController {

    private $arrivedProducts;

    public function __construct() {
        $this->arrivedProducts = new ArrivedProductModel();
    }

    public function arrivedProduct() {
        $result = $this->arrivedProducts->getArrivedProduct();
        $this->view('inventory/arrived_product/arrived_product', ['arrivedProducts' => $result]);
    }


    public function edit($id) {

        $result = $this->arrivedProducts->getArrivedProductById($id);
        $this->view("inventory/arrived_product/edit", ['arrivedProduct' => $result]);
    }

    public function update($id)
    {
        $productName = $_POST['productname'];
        $quantity = $_POST['quantity'];
        $orderDate = $_POST['orderdate'];
        $expectedDelivery = $_POST['expecteddelivery'];
        $supplier = $_POST['supplier'];
        $status = $_POST['status'];
        $this->arrivedProducts->updateArrivedProduct($id, $productName, $quantity, $order_date, $expected_delivery, $supplier, $status);
        $this->redirect('/arrived_product');
    }


    public function delete($id)
    {
        $this->arrivedProducts->deleteArrivedProduct($id);
        $this->redirect('/arrived_product');
    }

   
}

