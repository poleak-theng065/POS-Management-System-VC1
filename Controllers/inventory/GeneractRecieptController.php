<?php
require_once("Models/inventory/SaleFormModel.php");

class GenerateReceiptController extends BaseController
{
    private $sales;

    public function __construct()
    {
        $this->sales = new SaleFormModel();
    }

    public function index()
    {
        // Log the session variable
        error_log("Session new_sale_item in index: " . print_r($_SESSION['new_sale_item'] ?? 'Not set', true));

        // Check if there's a new sale item in the session
        $newSaleItem = $_SESSION['new_sale_item'] ?? null;
        $products = $this->sales->getProducts();

        // If there's a new sale item, fetch its product details
        $saleItems = [];
        if ($newSaleItem) {
            $productId = $newSaleItem['product_id'];
            $stmt = $this->sales->query(
                "SELECT barcode, unit_price FROM products WHERE product_id = ? LIMIT 1",
                [$productId]
            );
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product) {
                $newSaleItem['barcode'] = $product['barcode'];
                $newSaleItem['unit_price'] = $product['unit_price'];
                $saleItems = [$newSaleItem];
                error_log("Sale item with product details: " . print_r($newSaleItem, true));
            } else {
                error_log("Product not found for product_id: $productId");
            }
            // Clear the session variable after displaying
            unset($_SESSION['new_sale_item']);
        } else {
            error_log("No new sale item found in session");
        }

        $this->view("inventory/sale_form/generate_receipt", ["products" => $products, "saleItems" => $saleItems]);
    }

    public function create()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $this->view("inventory/sale_form/sale_form", ["products" => $products, "saleItems" => $saleItems]);
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
            error_log("Store method - product_id: $product_id, quantity: $quantity, sale_date: $sale_date, discount: $discount");

            // Validate required fields
            if (!$product_id || !$quantity) {
                $_SESSION['error'] = "Product ID and quantity are required.";
                header("Location: /generate_receipt/create");
                exit();
            }

            // Additional validation
            if ($quantity <= 0) {
                $_SESSION['error'] = "Quantity must be greater than 0.";
                header("Location: /generate_receipt/create");
                exit();
            }
            if ($discount < 0) {
                $_SESSION['error'] = "Discount cannot be negative.";
                header("Location: /generate_receipt/create");
                exit();
            }

            // Validate sale_date format
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $sale_date)) {
                $_SESSION['error'] = "Invalid sale date format. Expected YYYY-MM-DD.";
                header("Location: /generate_receipt/create");
                exit();
            }

            // Insert the sale record using the model's createSaleItem method
            $newSaleItem = $this->sales->createSaleItem($product_id, $quantity, $sale_date, $discount);

            // Attempt to commit the transaction
            $this->sales->query("COMMIT", []);

            // Set session messages based on success or failure
            if ($newSaleItem !== false) {
                $_SESSION['success'] = "Sale record created successfully!";
                // Store the new sale item in the session to display in the receipt
                $_SESSION['new_sale_item'] = $newSaleItem;
                error_log("Set new_sale_item in session: " . print_r($newSaleItem, true));
            } else {
                $_SESSION['error'] = "Failed to create sale record.";
                $this->sales->query("ROLLBACK", []);
                error_log("Failed to create sale item, session error set");
            }

            // Redirect to the receipt page
            header("Location: /generate_receipt");
            exit();
        }
    }
}