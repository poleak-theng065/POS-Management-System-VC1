<?php
require_once __DIR__ . "/../../Database/Database.php";

class TotalSoldModel
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
            error_log("Failed to initialize database connection in TotalSoldModel: " . $e->getMessage());
            throw $e;
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->db->query($sql, $params);
            if (!$stmt) {
                error_log("Query execution failed in TotalSoldModel: " . $sql . " with params: " . json_encode($params));
                return false;
            }
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query Error in TotalSoldModel: " . $e->getMessage() . " for query: " . $sql . " with params: " . json_encode($params));
            return false;
        }
    }

    public function getTotalQuantitySold()
    {
        try {
            $stmt = $this->query("SELECT SUM(quantity) AS total_quantity_sold FROM sale_items");

            if ($stmt === false) {
                throw new Exception("Failed to calculate total quantity sold in TotalSoldModel.");
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($result && $result['total_quantity_sold'] !== null) ? (int)$result['total_quantity_sold'] : 0;
        } catch (Exception $e) {
            error_log("Error fetching total quantity sold in TotalSoldModel: " . $e->getMessage());
            return 0;
        }
    }

    public function getTotalProfitForCurrentMonth()
    {
        try {
            $stmt = $this->query("
                SELECT SUM((products.unit_price - products.cost_price) * sale_items.quantity - sale_items.discount) AS total_profit 
                FROM sale_items 
                LEFT JOIN products ON sale_items.product_id = products.product_id
                WHERE MONTH(sale_items.sale_date) = MONTH(CURRENT_DATE())
                AND YEAR(sale_items.sale_date) = YEAR(CURRENT_DATE())
            ");

            if ($stmt === false) {
                throw new Exception("Failed to calculate total profit in TotalSoldModel.");
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Total Profit Result in TotalSoldModel: " . json_encode($result));
            return ($result && $result['total_profit'] !== null) ? floatval($result['total_profit']) : 0.00;
        } catch (Exception $e) {
            error_log("Error fetching total profit in TotalSoldModel: " . $e->getMessage());
            return 0.00;
        }
    }

    public function getTotalCostPriceForCurrentMonth()
    {
        try {
            $stmt = $this->query("
                SELECT SUM(products.cost_price * sale_items.quantity) AS total_cost_price
                FROM sale_items
                LEFT JOIN products ON sale_items.product_id = products.product_id
                WHERE MONTH(sale_items.sale_date) = MONTH(CURRENT_DATE())
                AND YEAR(sale_items.sale_date) = YEAR(CURRENT_DATE())
            ");

            if ($stmt === false) {
                throw new Exception("Failed to calculate total cost price in TotalSoldModel.");
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Total Cost Price Result in TotalSoldModel: " . json_encode($result));
            return ($result && $result['total_cost_price'] !== null) ? floatval($result['total_cost_price']) : 0.00;
        } catch (Exception $e) {
            error_log("Error fetching total cost price in TotalSoldModel: " . $e->getMessage());
            return 0.00;
        }
    }
}