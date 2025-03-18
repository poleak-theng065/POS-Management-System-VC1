<?php

class SaleFormController extends BaseController {
    private $sales;

    public function saleForm() {
        $this->view('inventory/sale_form/sale_form');
    }
}