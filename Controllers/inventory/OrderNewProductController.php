<?php

require_once ("Models/inventory/OrderNewProductModel.php");

class OrderNewProductController extends BaseController {

    private $newOrders;

    public function __construct() {
        $this->newOrders = new OrderNewProductModel();
    }

    public function orderNewProduct() {
        $result = $this->newOrders->getOrderNewProduct();
        $this->view('inventory/order_new_product/order_new_product', ['newOrders' => $result]);
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


    public function edit($id) {

        $result = $this->newOrders->getOrderNewProductById($id);
        $this->view("inventory/order_new_product/edit", ['newOrder' => $result]);
    }

    public function update($id)
    {
        $productName = $_POST['productname'];
        $quantity = $_POST['quantity'];
        $orderDate = $_POST['orderdate'];
        $expectedDelivery = $_POST['expecteddelivery'];
        $supplier = $_POST['supplier'];
        $this->newOrders->updateNewOrder($id, $productName, $quantity, $orderDate, $expectedDelivery, $supplier);
        $this->redirect('/order_new_product');
    }



    public function delete($id)
    {
        $this->newOrders->deleteOrderNew($id);
        $this->redirect('/order_new_product');
    }

   
}

