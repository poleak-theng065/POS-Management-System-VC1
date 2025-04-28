<?php
require_once "Database/Database.php";

class OrderStatisticsModel
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
            error_log("Failed to initialize database connection in OrderStatisticsModel: " . $e->getMessage());
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
            error_log("Query executed successfully: " . $sql);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query Error: " . $e->getMessage() . " for query: " . $sql . " with params: " . json_encode($params));
            return false;
        }
    }

    public function getCategoriesWithProductQuantities()
    {
        try {
            $sql = "
                SELECT 
                    categories.category_id,
                    categories.name,
                    COALESCE(SUM(products.stock_quantity), 0) AS total_quantity
                FROM categories
                LEFT JOIN products ON categories.category_id = products.category_id
                GROUP BY categories.category_id, categories.name
                ORDER BY categories.name ASC
            ";

            $stmt = $this->query($sql);

            if ($stmt === false) {
                throw new Exception("Failed to fetch categories with product quantities.");
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Fetched categories: " . print_r($result, true));
            return $result;
        } catch (Exception $e) {
            error_log("Error fetching categories with product quantities: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalProductQuantity()
    {
        try {
            $stmt = $this->query("SELECT SUM(stock_quantity) AS total_quantity FROM products");

            if ($stmt === false) {
                throw new Exception("Failed to calculate total product quantity.");
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $total = ($result && $result['total_quantity'] !== null) ? (int)$result['total_quantity'] : 0;
            error_log("Total product quantity: " . $total);
            return $total;
        } catch (Exception $e) {
            error_log("Error fetching total product quantity: " . $e->getMessage());
            return 0;
        }
    }
}