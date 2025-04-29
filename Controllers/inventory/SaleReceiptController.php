<?php

require_once("Models/inventory/SaleReceiptModel.php");

class SaleReceiptController extends BaseController
{
    private $saleModel;

    public function __construct()
    {
        $this->saleModel = new SaleReceiptModel();
    }

    public function getSales() {
        try {
            // Fetch sales data from the model
            $groupedSales = $this->saleModel->fetchSales();
            
            // Calculate totals based on the model's return structure
            $totalRevenue = 0;
            $totalItemsSold = 0;
            
            foreach ($groupedSales as $sale) {
                $totalRevenue += $sale['total_amount'];
                $totalItemsSold += count($sale['products']);
            }

            // Prepare data for the view
            $data = [
                'sales' => $groupedSales,
                'page_title' => 'Sales Receipts',
                'current_date' => date('Y-m-d'),
                'total_sales' => count($groupedSales), // Number of sales transactions
                'total_items' => $totalItemsSold,     // Total products sold across all transactions
                'total_revenue' => $totalRevenue,
                'average_sale' => count($groupedSales) > 0 ? $totalRevenue / count($groupedSales) : 0
            ];

            // Load the view with the sales data
            $this->view('inventory/sale_receipt/sale_receipt', $data);

        } catch (PDOException $e) {
            // Handle database-related errors
            error_log("Database error in getSales: " . $e->getMessage());
            $this->view('error/database_error', [
                'error_message' => 'Failed to retrieve sales data. Please try again later.',
                'page_title' => 'Database Error'
            ]);

        } catch (Exception $e) {
            // Handle any other general errors
            error_log("Error in getSales: " . $e->getMessage());
            $this->view('error/general_error', [
                'error_message' => 'An unexpected error occurred. Please try again later.',
                'page_title' => 'Application Error'
            ]);
        }
    }
}