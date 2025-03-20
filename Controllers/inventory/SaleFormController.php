<?php

class SaleFormController extends BaseController {
    private $sales;

    public function __construct() {
        $this->newOrders = new OrderNewProductModel();
    }

    public function saleForm() {
        $this->view('inventory/sale_form/sale_form');
    }

    public function store() {
        
    }


    
}