<?php
require_once("Models/inventory/SaleFormModel.php");

class SaleFormController extends BaseController
{
    private $sales;

    public function __construct()
    {
        $this->sales = new SaleFormModel();
    }

    public function index()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $this->view("inventory/sale_form/sale_form", [
            "products" => $products,
            "saleItems" => $saleItems
        ]);
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get JSON input
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);

            if (!$data || !isset($data['products'])) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Invalid or missing product data']);
                exit();
            }

            $products = $data['products'];
            $success = true;
            $errorMessage = '';

            // Process each product
            foreach ($products as $product) {
                $product_id = isset($product['product_id']) ? (int)$product['product_id'] : null;
                $quantity = isset($product['quantity']) ? (int)$product['quantity'] : null;
                $sale_date = $product['sale_date'] ?? date('Y-m-d');
                $discount = isset($product['discount']) ? (float)$product['discount'] : 0.00;

                // Log the input data for debugging
                error_log("Store method - product_id: $product_id, quantity: $quantity, sale_date: $sale_date, discount: $discount");

                // Validate required fields
                if (!$product_id || !$quantity) {
                    $success = false;
                    $errorMessage = "Product ID and quantity are required.";
                    break;
                }

                if ($quantity <= 0) {
                    $success = false;
                    $errorMessage = "Quantity must be greater than 0.";
                    break;
                }
                if ($discount < 0) {
                    $success = false;
                    $errorMessage = "Discount cannot be negative.";
                    break;
                }
                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $sale_date)) {
                    $success = false;
                    $errorMessage = "Invalid sale date format. Expected YYYY-MM-DD.";
                    break;
                }

                // Create the sale item
                $result = $this->sales->createSaleItem($product_id, $quantity, $sale_date, $discount);
                if ($result !== true) {
                    $success = false;
                    $errorMessage = "Failed to create sale record: " . htmlspecialchars($result);
                    break;
                }
            }

            // Send JSON response
            header('Content-Type: application/json');
            if ($success) {
                echo json_encode(['success' => true, 'message' => 'Sale records created successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => $errorMessage]);
            }
            exit();
        }
    }
}