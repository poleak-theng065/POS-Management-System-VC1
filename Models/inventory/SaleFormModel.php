<?php
// require_once "Database/Database.php";

// class SaleFormModel
// {
//     private $db;

//     public function __construct()
//     {
//         $host = "localhost";
//         $dbname = "inventorydb";
//         $username = "root";
//         $password = "";

//         $this->db = new Database($host, $dbname, $username, $password);
//     }

//     public function getCustomerByDetails($name, $contact_number)
//     {
//         try {
//             $stmt = $this->db->query("SELECT customer_id FROM customers WHERE name = ? AND contact_number = ?", [$name, $contact_number]);
//             $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            
//             error_log("Customer found: " . json_encode($customer)); // Log customer details
    
//             return $customer;
//         } catch (Exception $e) {
//             error_log("Error fetching customer: " . $e->getMessage());
//             return null;
//         }
//     }
    
    
//     public function createCustomer($name, $contact_number)
//     {
//         try {
//             $sql = "INSERT INTO customers (name, contact_number) VALUES (:name, :contact_number)";
//             $this->db->query($sql, [':name' => $name, ':contact_number' => $contact_number]);
    
//             // Get the last inserted ID from the PDO instance directly
//             $lastInsertId = $this->db->lastInsertId();  // No need for a separate getPDO method
    
//             if ($lastInsertId) {
//                 return $lastInsertId;
//             } else {
//                 error_log("Error: Failed to retrieve the last inserted customer ID.");
//                 return null;
//             }
//         } catch (Exception $e) {
//             error_log("Error inserting customer: " . $e->getMessage());
//             return null;
//         }
//     }
      
    

//     public function getProducts()
//     {
//         try {
//             $stmt = $this->db->query("SELECT * FROM products");
//             return $stmt->fetchAll(PDO::FETCH_ASSOC);
//         } catch (Exception $e) {
//             error_log("Error fetching products: " . $e->getMessage());
//             return [];
//         }
//     }

//     public function getSaleItems()
//     {
//         try {
//             $stmt = $this->db->query("
//             SELECT sale_items.*, 
//                    customers.name AS customer_name, 
//                    customers.contact_number, 
//                    products.name AS product_name, 
//                    products.barcode
//             FROM sale_items
//             LEFT JOIN customers ON sale_items.customer_id = customers.customer_id
//             LEFT JOIN products ON sale_items.product_id = products.product_id
//             ORDER BY sale_items.sale_item_id DESC
//         ");
//             return $stmt->fetchAll(PDO::FETCH_ASSOC);
//         } catch (Exception $e) {
//             error_log("Error fetching sale items: " . $e->getMessage());
//             return [];
//         }
//     }

//     public function createSaleItems($data)
//     {
//         try {
//             error_log("Sale item data: " . json_encode($data));
    
//             $sql = 'INSERT INTO sale_items (customer_id, product_id, quantity, unit_price, total_price) 
//                     VALUES (:customer_id, :product_id, :quantity, :unit_price, :total_price)';
    
//             $stmt = $this->db->query($sql, [
//                 ':customer_id' => $data['customer_id'],
//                 ':product_id' => $data['product_id'],
//                 ':quantity' => $data['quantity'],
//                 ':unit_price' => $data['unit_price'],
//                 ':total_price' => $data['total_price'],
//             ]);
    
//             return $stmt ? true : false;
//         } catch (Exception $e) {
//             error_log("Error inserting sale item: " . $e->getMessage());
//             return false;
//         }
//     }
    
// }
