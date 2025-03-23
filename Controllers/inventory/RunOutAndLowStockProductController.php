<?php

require_once ("Models/inventory/RunOutAndLowStockProductModel.php");

class RunOutAndLowStockProductController extends BaseController {

    private $runOutAndLowStockProducts;

    public function __construct() {
        $this->runOutAndLowStockProducts = new RunOutAndLowStockProductModel();

    }

    public function runOutAndLowStockProduct() {
        $result = $this->runOutAndLowStockProducts->getRunOutAndLowStockProduct();
        $this->view('inventory/run_out_and_low_stock_product/run_out_and_low_stock_product', ['runOutAndLowStockProducts' => $result]);
    }

}