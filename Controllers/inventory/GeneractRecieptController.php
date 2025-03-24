<?php
require_once("Models/inventory/SaleFormModel.php");

// class SaleFormController extends BaseController
// {
//     private $sales;

//     public function __construct()
//     {
//         $this->sales = new SaleFormModel();
//     }

//     public function saleForm()
//     {
//         $this->view('inventory/sale_form/sale_form');
//     }

//     public function index()
//     {
//         $products = $this->sales->getProducts();
//         $customers = $this->sales->getCustomerByDetails($customer_name, $contact_number);
//         $saleItems = $this->sales->getSaleItems();
//         $this->view("inventory/sale_form/sale_form", ["products" => $products, "customers" => $customers, "saleItems" => $saleItems]);
//     }

//     public function store()
//     {
//         session_start();
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $customer_name = $_POST['customer_name'] ?? null;
//             $contact_number = $_POST['contact_number'] ?? null;
//             $product_id = $_POST['product_id'] ?? null;

//             if (!$customer_name || !$contact_number || !$product_id) {
//                 $_SESSION['error'] = "Error: All required fields must be filled.";
//                 $this->redirect('/sale_form/generate_receipt');
//                 return;
//             }

//             // Check if the customer exists
//             $customer = $this->sales->getCustomerByDetails($customer_name, $contact_number);
//             if (!$customer) {
//                 $customer_id = $this->sales->createCustomer($customer_name, $contact_number);
//                 if (!$customer_id) {
//                     $_SESSION['error'] = "Error: Unable to create customer.";
//                     $this->redirect('/sale_form/generate_receipt');
//                     return;
//                 }
//             } else {
//                 $customer_id = $this->sales->createCustomer($customer_name, $contact_number);
//             }

//             // Prepare sale data
//             $data = [
//                 'customer_id' => $customer_id,
//                 'product_id' => $product_id,
//                 'quantity' => $_POST['quantity'] ?? null,
//                 'unit_price' => $_POST['unit_price'] ?? null,
//                 'total_price' => $_POST['total_price'] ?? null,
//             ];

//             // Validate numeric fields
//             if (!filter_var($data['quantity'], FILTER_VALIDATE_INT) || $data['quantity'] <= 0 ||
//                 !filter_var($data['unit_price'], FILTER_VALIDATE_FLOAT) || $data['unit_price'] <= 0 ||
//                 !filter_var($data['total_price'], FILTER_VALIDATE_FLOAT) || $data['total_price'] <= 0) {
//                 $_SESSION['error'] = "Error: Invalid quantity or price values.";
//                 $this->redirect('/sale_form/generate_receipt');
//                 return;
//             }

//             // Insert sale
//             if ($this->sales->createSaleItems($data)) {
//                 $_SESSION['success'] = "Sale item created successfully!";
//                 echo "<script>
//                         localStorage.setItem('saleItemStatus', 'success');
//                         window.location.href = '/sale_form/generate_receipt';
//                       </script>";
//             } else {
//                 $_SESSION['error'] = "Error: Unable to create sale item.";
//                 echo "<script>
//                         localStorage.setItem('saleItemStatus', 'fail');
//                         window.location.href = '/sale_form/generate_receipt';
//                       </script>";
//             }
//         }
//     }
// }
