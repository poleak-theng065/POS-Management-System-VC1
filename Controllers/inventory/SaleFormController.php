<?php
require_once("Models/inventory/SaleFormModel.php");

class SaleFormController extends BaseController
{
    private $sales;

    public function __construct()
    {
        $this->sales = new SaleFormModel();
    }

    public function saleForm()
    {
        $this->view('inventory/sale_form/sale_form');
    }

    public function index()
    {
        $products = $this->sales->getProducts();
        $saleItems = $this->sales->getSaleItems();
        $this->view("inventory/sale_form/sale_form", ["products" => $products, "saleItems" => $saleItems]);
    }

    public function create()
    {
        $saleItems = $this->sales->getSaleItems(); 
        $this->view("inventory/sale_form/sale_form", ["saleItems" => $saleItems]); 
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and sanitize input
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $unit_price = $_POST['unit_price'] ?? null;

            // Calculate total price
            $total_price = $quantity * $unit_price;

            // Validate required fields
            if (!$product_id || !$quantity || !$unit_price) {
                $_SESSION['error'] = "All fields are required.";
                header("Location: /sale_form/generate_receipt");
                exit();
            }

            // Prepare data for insertion
            $data = [
                'product_id' => $product_id,
                'quantity' => $quantity,
                'unit_price' => $unit_price,
                'total_price' => $total_price,
            ];

            // Insert the sale record
            $isCreated = $this->sales->createSaleForm($data);

            // Set session messages based on success or failure
            if ($isCreated) {
                $_SESSION['success'] = "Sale record created successfully!";
            } else {
                $_SESSION['error'] = "Failed to create sale record.";
            }

            // Redirect back to the sale form page
            header("Location: /sale_form/generate_receipt");
            exit();
        }
    }
}
