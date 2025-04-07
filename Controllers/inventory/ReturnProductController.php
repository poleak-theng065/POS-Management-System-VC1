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
        $productName = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $reason_return = $_POST['reason_for_return'];
        $type_return = $_POST['type_of_return'];
        $return_date = $_POST['return_date'];
        $this->returnProducts->addNewReturnProduct($productName, $quantity, $reason_return, $type_return, $return_date);
        $this->redirect('/return_product');
    }


    public function edit($id) {

        $result = $this->returnProducts->getReturnProductById($id);
        $this->view("inventory/return_product/edit", ['returnProduct' => $result]);
    }

    public function update($id)
    {
        $productName = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $reason_return = $_POST['reason_for_return'];
        $type_return = $_POST['type_of_return'];
        $return_date = $_POST['return_date'];
        $this->returnProducts->updateReturnProduct($id, $productName, $quantity, $reason_return, $type_return, $return_date);
        $this->redirect('/return_product');
    }

    public function delete($id)
    {
        $this->returnProducts->deleteReturnProduct($id);
        $this->redirect('/return_product');
    }


   
}

