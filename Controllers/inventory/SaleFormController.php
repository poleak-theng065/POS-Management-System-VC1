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
            // Retrieve and sanitize input
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : null;
            $sale_date = $_POST['sale_date'] ?? date('Y-m-d');
            $discount = isset($_POST['discount']) ? (float)$_POST['discount'] : 0.00;

            // Log the input data for debugging
            error_log("Store method (SaleFormController) - product_id: $product_id, quantity: $quantity, sale_date: $sale_date, discount: $discount");

            // Validate required fields
            if (!$product_id || !$quantity) {
                $_SESSION['error'] = "Product and quantity are required.";
                header("Location: /sale_form");
                exit();
            }

            // Additional validation
            if ($quantity <= 0) {
                $_SESSION['error'] = "Quantity must be greater than 0.";
                header("Location: /sale_form");
                exit();
            }
            if ($discount < 0) {
                $_SESSION['error'] = "Discount cannot be negative.";
                header("Location: /sale_form");
                exit();
            }
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $sale_date)) {
                $_SESSION['error'] = "Invalid sale date format. Expected YYYY-MM-DD.";
                header("Location: /sale_form");
                exit();
            }

            // Create the sale item
            $result = $this->sales->createSaleItem($product_id, $quantity, $sale_date, $discount);

            // Set session messages based on success or failure
            if ($result === true) {
                $_SESSION['success'] = "Sale record created successfully!";
            } else {
                $_SESSION['error'] = "Failed to create sale record: " . htmlspecialchars($result);
            }

            // Redirect back to the sale form page
            header("Location: /sale_form");
            exit();
        }
    }
}