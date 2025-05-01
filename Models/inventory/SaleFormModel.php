<?php
require_once "Database/Database.php";

class SaleFormModel
{
    private $db;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "pos-system";
        $username = "root";
        $password = "PassWord@123!";

        try {
            $this->db = new Database($host, $dbname, $username, $password);
        } catch (Exception $e) {
            error_log("Failed to initialize database connection: " . $e->getMessage());
            throw $e;
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->db->query($sql, $params);
            if (!$stmt) {
                error_log("Query execution failed: " . $sql . " with params: " . json_encode($params));
                return false;
            }
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query Error: " . $e->getMessage() . " for query: " . $sql . " with params: " . json_encode($params));
            return false;
        }
    }

    public function getProducts()
    {
        try {
            $stmt = $this->query("SELECT product_id, barcode, name, brand, unit_price, image_path FROM products");
            if ($stmt === false) {
                throw new Exception("Failed to fetch products.");
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return [];
        }
    }

    public function getSaleItems()
    {
        try {
            $stmt = $this->query("
                SELECT sale_items.sale_item_id, 
                       sale_items.product_id, 
                       sale_items.quantity, 
                       sale_items.sale_date, 
                       sale_items.discount, 
                       sale_items.total_price, 
                       products.barcode,
                       products.name,
                       products.brand,
                       products.image_path
                FROM sale_items
                LEFT JOIN products ON sale_items.product_id = products.product_id
                ORDER BY sale_items.sale_item_id DESC
            ");
            if ($stmt === false) {
                throw new Exception("Failed to fetch sale items.");
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching sale items: " . $e->getMessage());
            return [];
        }
    }

    public function createSale($saleData) {
        $this->db->beginTransaction();
        
        try {
            // 1. Insert sale header
            $this->db->query(
                "INSERT INTO sales (total_amount, total_discount, payment_method, customer_name, phone_number, address) 
                VALUES (?, ?, ?, ?, ?, ?)",
                [
                    $saleData['total_amount'],
                    $saleData['total_discount'],
                    $saleData['payment_method'],
                    $saleData['customer_name'] ?? null,
                    $saleData['phone_number'] ?? null,
                    $saleData['address'] ?? null
                ]
            );
            
            $saleId = $this->db->lastInsertId();
            
            // 2. Insert all sale items and reduce product quantities
            foreach ($saleData['items'] as $item) {
                // Insert sale item
                $this->db->query(
                    "INSERT INTO sale_items (sale_id, product_id, quantity, unit_price, discount)
                    VALUES (?, ?, ?, ?, ?)",
                    [
                        $saleId,
                        $item['product_id'],
                        $item['quantity'],
                        $item['unit_price'],
                        $item['discount']
                    ]
                );
    
                // Directly reduce product quantity here
                $stmt = $this->db->query(
                    "UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?",
                    [
                        $item['quantity'],
                        $item['product_id']
                    ]
                );
    
                if ($stmt === false) {
                    throw new Exception("Failed to reduce product quantity for product ID: " . $item['product_id']);
                }
            }
            
            $this->db->commit();
            return ['success' => true, 'sale_id' => $saleId];
            
        } catch (Exception $e) {
            $this->db->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    

    public function getUnitPriceByBarcode($barcode)
    {
        try {
            $stmt = $this->query(
                "SELECT unit_price FROM products WHERE barcode = ? LIMIT 1",
                [$barcode]
            );
            if ($stmt === false) {
                throw new Exception("Failed to fetch unit price for barcode: $barcode");
            }
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['unit_price'] : null;
        } catch (Exception $e) {
            error_log("Error fetching unit price by barcode: " . $e->getMessage());
            return null;
        }
    }
}