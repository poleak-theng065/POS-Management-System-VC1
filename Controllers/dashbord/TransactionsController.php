<?php
require_once __DIR__ . "/../BaseController.php";
require_once __DIR__ . "/../../Models/dashbord/TransactionsModel.php";

class TransactionsController {
    private $transactionsModel;

    public function __construct() {
        $this->transactionsModel = new TransactionsModel();
    }

    public function index() {
        // Fetch stock status
        $stock_data = $this->transactionsModel->getStockStatus();

        // Debug: Log the stock data
        error_log("Stock data in TransactionsController: " . print_r($stock_data, true));

        // Prepare data for the view
        $data = [
            'low_stock_products' => $stock_data['low_stock'],
            'out_of_stock_products' => $stock_data['out_of_stock']
        ];

        // Debug: Log the prepared data
        error_log("Prepared data in TransactionsController: " . print_r($data, true));

        return $data;
    }
}