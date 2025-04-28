<?php
require_once __DIR__ . "/../../Database/Database.php";

class TransactionsModel {
    private $db;

    public function __construct() {
        // Initialize the Database with connection parameters
        $host = "localhost";
        $dbname = "pos-system";
        $username = "root";
        $password = "";

        try {
            $this->db = new Database($host, $dbname, $username, $password);
            error_log("Database connection successful in TransactionsModel");
        } catch (Exception $e) {
            error_log("Failed to initialize database connection in TransactionsModel: " . $e->getMessage());
            throw $e;
        }
    }

    public function getStockStatus() {
        // Fetch name, stock_quantity, and image_path
        $query = "SELECT name, stock_quantity, image_path FROM products WHERE stock_quantity <= 5 ORDER BY stock_quantity ASC";
        
        error_log("Executing query in TransactionsModel: " . $query);

        try {
            $stmt = $this->db->query($query);
        } catch (Exception $e) {
            error_log("Query execution failed in TransactionsModel: " . $e->getMessage());
            return [
                'low_stock' => [],
                'out_of_stock' => []
            ];
        }

        $low_stock = [];
        $out_of_stock = [];

        if ($stmt === false) {
            error_log("Query failed in TransactionsModel: " . $query);
            return [
                'low_stock' => $low_stock,
                'out_of_stock' => $out_of_stock
            ];
        }

        $results = $this->db->resultSet($stmt);
        error_log("Query results in TransactionsModel: " . print_r($results, true));

        foreach ($results as $row) {
            if ($row['stock_quantity'] == 0) {
                $out_of_stock[] = $row;
            } else {
                $low_stock[] = $row;
            }
        }

        error_log("Low stock products in TransactionsModel: " . print_r($low_stock, true));
        error_log("Out of stock products in TransactionsModel: " . print_r($out_of_stock, true));

        return [
            'low_stock' => $low_stock,
            'out_of_stock' => $out_of_stock
        ];
    }
}