<?php

require_once("Models/inventory/SaleReceiptModel.php");

class SaleReceiptController extends BaseController
{
    private $newOrders;

    public function __construct()
    {
        $this->newOrders = new SaleReceiptModel();
    }

   public function getSales(){
        $sales = $this->newOrders->fetchSales();
        $this->view('inventory/sale_receipt/sale_receipt', ['sales' => $sales]);
   }
}
