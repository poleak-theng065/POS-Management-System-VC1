<?php
require_once "Database/Database.php";

class SoldProductModel
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
            $stmt = $this->query("SELECT product_id, barcode, name, brand, unit_price FROM products");
            if ($stmt === false) {
                throw new Exception("Failed to fetch products.");
            }
            return $this->db->resultSet($stmt);
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return [];
        }
    }

    public function getSaleItems()
    {
        try {
            $stmt = $this->query("
                SELECT  
                    MIN(sale_items.sale_item_id) AS sale_item_id, 
                    sale_items.product_id, 
                    SUM(sale_items.quantity) AS quantity, 
                    SUM(sale_items.discount) AS discount, 
                    SUM(sale_items.total_price) AS total_price, 
                    products.barcode,
                    products.name,
                    products.brand,
                    products.image_path,
                    products.unit_price,
                    products.cost_price,
                    SUM((COALESCE(products.unit_price, 0) - COALESCE(products.cost_price, 0)) * sale_items.quantity - sale_items.discount) AS profit
                FROM sale_items
                LEFT JOIN products ON sale_items.product_id = products.product_id
                GROUP BY products.barcode, products.name, sale_items.product_id, products.brand, products.image_path, products.unit_price, products.cost_price
                ORDER BY MIN(sale_items.sale_item_id) DESC
            ");

            if ($stmt === false) {
                throw new Exception("Failed to fetch sale items.");
            }

            $saleItems = $this->db->resultSet($stmt);
            error_log("Sale items fetched: " . json_encode($saleItems));
            return $saleItems;
        } catch (Exception $e) {
            error_log("Error fetching sale items: " . $e->getMessage());
            return [];
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
            $result = $this->db->single($stmt);
            return $result ? $result['unit_price'] : null;
        } catch (Exception $e) {
            error_log("Error fetching unit price by barcode: " . $e->getMessage());
            return null;
        }
    }

    public function getTotalProfit()
    {
        try {
            // Log the raw data before the calculation
            $rawStmt = $this->query("
                SELECT 
                    sale_items.product_id, 
                    sale_items.quantity, 
                    sale_items.discount, 
                    products.unit_price, 
                    products.cost_price
                FROM sale_items 
                LEFT JOIN products ON sale_items.product_id = products.product_id
            ");
            if ($rawStmt !== false) {
                $rawData = $this->db->resultSet($rawStmt);
                error_log("Raw data for profit calculation: " . json_encode($rawData));
            }

            $stmt = $this->query("
                SELECT SUM((COALESCE(products.unit_price, 0) - COALESCE(products.cost_price, 0)) * sale_items.quantity - sale_items.discount) AS total_profit 
                FROM sale_items 
                LEFT JOIN products ON sale_items.product_id = products.product_id
            ");

            if ($stmt === false) {
                throw new Exception("Failed to calculate total profit.");
            }

            $result = $this->db->single($stmt);
            error_log("Total profit result: " . json_encode($result));
            return ($result && $result['total_profit'] !== null) ? floatval($result['total_profit']) : 0.00;
        } catch (Exception $e) {
            error_log("Error fetching total profit: " . $e->getMessage());
            return 0.00;
        }
    }
}