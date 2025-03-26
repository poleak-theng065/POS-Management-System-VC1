<?php
require_once "Database/Database.php";

class SaleFormModel
{
    private $db;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "inventorydb";
        $username = "root";
        $password = "";

        $this->db = new Database($host, $dbname, $username, $password);
    }

    public function query($sql, $params = [])
    {
        try {
            // Use the query method from Database.php
            $stmt = $this->db->query($sql, $params);

            if (!$stmt) {
                error_log("Query execution failed.");
                return false;
            }

            return $stmt;
        } catch (PDOException $e) {
            error_log("Query Error: " . $e->getMessage());
            return false;
        }
    }

    public function getProducts()
    {
        try {
            $stmt = $this->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Fetched products: " . print_r($products, true));
            return $products;
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
                       products.unit_price
                FROM sale_items
                LEFT JOIN products ON sale_items.product_id = products.product_id
                ORDER BY sale_items.sale_item_id DESC
            ");
            $saleItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Fetched sale items: " . print_r($saleItems, true));
            return $saleItems;
        } catch (Exception $e) {
            error_log("Error fetching sale items: " . $e->getMessage());
            return [];
        }
    }

    public function createSaleItem($productId, $quantity, $saleDate, $discount)
    {
        try {
            // Log the input parameters for debugging
            error_log("Creating sale item with productId: $productId, quantity: $quantity, saleDate: $saleDate, discount: $discount");

            // Ensure productId and quantity are integers, as they are INT columns in the database
            $productId = (int)$productId;
            $quantity = (int)$quantity;

            // Ensure saleDate is in the correct format (YYYY-MM-DD)
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $saleDate)) {
                throw new Exception("Invalid sale date format: $saleDate. Expected YYYY-MM-DD.");
            }

            // Ensure discount is a float, as it is a DECIMAL(5,2) column
            $discount = (float)$discount;
            if ($discount > 999.99) {
                throw new Exception("Discount exceeds maximum value of 999.99 for DECIMAL(5,2)");
            }

            // Fetch unit_price from products table using positional placeholder
            $stmt = $this->query(
                "SELECT unit_price FROM products WHERE product_id = ? LIMIT 1",
                [$productId]
            );
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new Exception("Product not found for product_id: $productId");
            }

            $unitPrice = floatval($result['unit_price']);
            $totalPrice = ($unitPrice * $quantity) - $discount;

            // Ensure totalPrice is a float and fits within DECIMAL(10,2) (max 99999999.99)
            $totalPrice = (float)$totalPrice;
            if ($totalPrice > 99999999.99) {
                throw new Exception("Total price exceeds maximum value of 99999999.99 for DECIMAL(10,2)");
            }

            // Log the calculated values
            error_log("Unit price: $unitPrice, Total price: $totalPrice");

            // Use a placeholder customer_id (e.g., 0) since the column is NOT NULL
            $customerId = 0;

            // Verify customer_id exists in customers table
            $stmt = $this->query(
                "SELECT customer_id FROM customers WHERE customer_id = ? LIMIT 1",
                [$customerId]
            );
            $customerResult = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$customerResult) {
                throw new Exception("Customer not found for customer_id: $customerId");
            }

            // Log the parameters being passed to the INSERT query
            $params = [$productId, $customerId, $quantity, $saleDate, $discount, $totalPrice];
            error_log("INSERT parameters: " . print_r($params, true));

            // Insert the new sale item, including customer_id
            $stmt = $this->query(
                "INSERT INTO sale_items (product_id, customer_id, quantity, sale_date, discount, total_price)
                VALUES (?, ?, ?, ?, ?, ?)",
                $params
            );

            // Check the number of affected rows
            $rowCount = $stmt->rowCount();
            error_log("Inserted sale item, affected rows: $rowCount");

            // If no rows were affected, throw an exception
            if ($rowCount === 0) {
                throw new Exception("Failed to insert sale item: No rows affected");
            }

            // Retrieve the newly inserted sale item
            $stmt = $this->query(
                "SELECT sale_item_id, product_id, customer_id, quantity, sale_date, discount, total_price
                 FROM sale_items
                 WHERE product_id = ? AND customer_id = ? AND quantity = ? AND sale_date = ? AND discount = ? AND total_price = ?
                 LIMIT 1",
                [$productId, $customerId, $quantity, $saleDate, $discount, $totalPrice]
            );
            $newSaleItem = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$newSaleItem) {
                throw new Exception("Failed to retrieve newly inserted sale item");
            }

            // Log the retrieved sale item
            error_log("Newly inserted sale item: " . print_r($newSaleItem, true));

            // Attempt to commit the transaction
            $this->query("COMMIT", []);
            error_log("Transaction committed");

            // Verify the record is in the database after commit
            $stmt = $this->query(
                "SELECT * FROM sale_items WHERE sale_item_id = ?",
                [$newSaleItem['sale_item_id']]
            );
            $verifyRecord = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Verified record after commit: " . print_r($verifyRecord, true));

            return $newSaleItem;
        } catch (Exception $e) {
            // Attempt to rollback the transaction
            $this->query("ROLLBACK", []);
            error_log("Transaction rolled back due to error: " . $e->getMessage());
            return false;
        }
    }

    public function getUnitPriceByBarcode($barcode)
    {
        try {
            $stmt = $this->query(
                "SELECT unit_price FROM products WHERE barcode = ? LIMIT 1",
                [$barcode]
            );
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['unit_price'];
            } else {
                return null; // Barcode not found
            }
        } catch (Exception $e) {
            error_log("Error fetching unit price by barcode: " . $e->getMessage());
            return null;
        }
    }

    public function getSaleItem($id)
    {
        $stmt = $this->query(
            "SELECT * FROM sale_items WHERE sale_item_id = ?",
            [$id]
        );
        $saleItem = $stmt->fetch(PDO::FETCH_ASSOC);
        return $saleItem;
    }

}
