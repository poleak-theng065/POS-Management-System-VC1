<?php
require_once("Models/inventory/SaleFormModel.php");

class SaleFormController extends BaseController
{
    private $salesModel;

    public function __construct()
    {
        $this->salesModel = new SaleFormModel();
    }

    public function index()
    {
        $products = $this->salesModel->getProducts();
        $saleItems = $this->salesModel->getSaleItems();
        $this->view("inventory/sale_form/sale_form", [
            "products" => $products,
            "saleItems" => $saleItems
        ]);
    }

    public function handleSale()
    {
        // Clear any previous output
        ob_clean();
        
        // Set JSON headers
        header('Content-Type: application/json');
        
        try {
            // Get and validate input
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input || !isset($input['items'])) {
                throw new Exception('Invalid sale data');
            }

            // Calculate totals
            $subtotal = 0;
            $totalDiscount = 0;
            
            foreach ($input['items'] as $item) {
                $subtotal += $item['unit_price'] * $item['quantity'];
                $totalDiscount += ($item['discount'] ?? 0) * $item['quantity'];
            }

            // Process sale
            $result = $this->salesModel->createSale([
                'total_amount' => $subtotal - $totalDiscount,
                'total_discount' => $totalDiscount,
                'payment_method' => $input['payment_method'] ?? 'cash',
                'customer_name' => $input['customer_name'] ?? '',
                'phone_number' => $input['phone_number'] ?? '',
                'address' => $input['address'] ?? '',
                'items' => $input['items']
            ]);

            if (!$result['success']) {
                throw new Exception($result['message']);
            }

            // Success response
            echo json_encode([
                'success' => true,
                'sale_id' => $result['sale_id'],
                'message' => 'Sale completed'
            ]);
            
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        
        exit; // Ensure no further output
    }
}