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
        $password = "";

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

    public function createSaleItem($productId, $quantity, $saleDate, $discount)
    {
        try {
            // Log the input parameters
            error_log("createSaleItem called with productId: $productId, quantity: $quantity, saleDate: $saleDate, discount: $discount");

            // Validate inputs
            $productId = (int)$productId;
            $quantity = (int)$quantity;
            $discount = (float)$discount;

            if ($productId <= 0) {
                throw new Exception("Invalid product ID: $productId");
            }
            if ($quantity <= 0) {
                throw new Exception("Quantity must be greater than 0: $quantity");
            }
            if ($discount < 0) {
                throw new Exception("Discount cannot be negative: $discount");
            }
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $saleDate)) {
                throw new Exception("Invalid sale date format: $saleDate. Expected YYYY-MM-DD.");
            }
            if ($discount > 999.99) {
                throw new Exception("Discount exceeds maximum value of 999.99 for DECIMAL(5,2): $discount");
            }

            // Fetch product details (unit_price, stock_quantity)
            $stmt = $this->query(
                "SELECT unit_price, stock_quantity FROM products WHERE product_id = ? LIMIT 1",
                [$productId]
            );
            if ($stmt === false) {
                throw new Exception("Failed to fetch product details for product_id: $productId");
            }
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$product) {
                throw new Exception("Product not found for product_id: $productId");
            }
            error_log("Product fetched: " . json_encode($product));

            $unitPrice = floatval($product['unit_price']);
            $currentStock = (int)$product['stock_quantity'];

            // Check if stock is available
            if ($currentStock < $quantity) {
                throw new Exception("Not enough stock available. Current stock: $currentStock, requested: $quantity");
            }

            // Calculate total price
            $totalPrice = ($unitPrice * $quantity) - $discount;
            if ($totalPrice < 0) {
                throw new Exception("Total price cannot be negative: $totalPrice");
            }
            if ($totalPrice > 99999999.99) {
                throw new Exception("Total price exceeds maximum value of 99999999.99 for DECIMAL(10,2): $totalPrice");
            }
            error_log("Total price calculated: $totalPrice");

            // Start transaction
            $this->db->beginTransaction();

            // Insert the sale item
            $insertSaleStmt = $this->query(
                "INSERT INTO sale_items (product_id, quantity, sale_date, discount, total_price)
                VALUES (?, ?, ?, ?, ?)",
                [$productId, $quantity, $saleDate, $discount, $totalPrice]
            );
            if ($insertSaleStmt === false) {
                throw new Exception("Failed to insert sale item.");
            }

            // Reduce product quantity in stock
            $updateStockStmt = $this->query(
                "UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?",
                [$quantity, $productId]
            );
            if ($updateStockStmt === false) {
                throw new Exception("Failed to update product stock.");
            }

            // Commit transaction
            $this->db->commit();

            error_log("Sale item created successfully and stock updated.");

            return true;
        } catch (Exception $e) {
            // Rollback if there's an error
            $this->db->rollBack();
            error_log("Error creating sale item: " . $e->getMessage());
            return $e->getMessage();
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