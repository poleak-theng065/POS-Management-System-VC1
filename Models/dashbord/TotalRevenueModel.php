<?php
require_once __DIR__ . "/../../Database/Database.php";

class TotalRevenueModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new Database('localhost', 'pos-system', 'root', '');
            $stmt = $this->db->query("SELECT 1");
            $result = $this->db->single($stmt);
            error_log("Database connection test in TotalRevenueModel: " . print_r($result, true));
        } catch (Exception $e) {
            error_log("Error in TotalRevenueModel constructor: " . $e->getMessage());
            die('Error: ' . $e->getMessage());
        }
    }

    public function getYearlyRevenue($startDate, $endDate) {
        $query = "
            SELECT SUM(si.total_price) as total_revenue
            FROM sale_items si
            JOIN products p ON si.product_id = p.product_id
            WHERE si.sale_date BETWEEN :start_date AND :end_date
        ";

        try {
            $stmt = $this->db->query($query, [
                ':start_date' => $startDate,
                ':end_date' => $endDate
            ]);
            $result = $this->db->single($stmt);
            error_log("Total Revenue Query Result (Start: $startDate, End: $endDate): " . print_r($result, true));
            $totalRevenue = isset($result['total_revenue']) ? floatval($result['total_revenue']) : 0;
            return $totalRevenue;
        } catch (Exception $e) {
            error_log("Error in getYearlyRevenue: " . $e->getMessage());
            return 0;
        }
    }

    public function getMonthlyRevenue($startDate, $endDate) {
        $query = "
            SELECT 
                DATE_FORMAT(si.sale_date, '%Y-%m') as month,
                SUM(si.total_price) as revenue
            FROM sale_items si
            JOIN products p ON si.product_id = p.product_id
            WHERE si.sale_date BETWEEN :start_date AND :end_date
            GROUP BY DATE_FORMAT(si.sale_date, '%Y-%m')
            ORDER BY month ASC
        ";

        try {
            $stmt = $this->db->query($query, [
                ':start_date' => $startDate,
                ':end_date' => $endDate
            ]);
            $results = $this->db->resultSet($stmt);
            error_log("Monthly Revenue Data Query Result (Start: $startDate, End: $endDate): " . print_r($results, true));

            $monthlyData = [];
            foreach ($results as $row) {
                $monthName = DateTime::createFromFormat('Y-m', $row['month'])->format('M Y');
                $revenue = floatval($row['revenue'] ?? 0);

                $monthlyData[] = [
                    'month' => $monthName,
                    'revenue' => $revenue,
                ];
            }

            // Fill in missing months with 0 revenue
            $start = new DateTime($startDate);
            $end = new DateTime($endDate);
            $interval = new DateInterval('P1M');
            $dateRange = new DatePeriod($start, $interval, $end->modify('+1 month'));
            $allMonths = [];
            foreach ($dateRange as $date) {
                $monthName = $date->format('M Y');
                $allMonths[$monthName] = [
                    'month' => $monthName,
                    'revenue' => 0,
                ];
            }

            foreach ($monthlyData as $data) {
                $allMonths[$data['month']] = $data;
            }

            $monthlyData = array_values($allMonths);
            error_log("Processed Monthly Revenue Data: " . print_r($monthlyData, true));
            return $monthlyData;
        } catch (Exception $e) {
            error_log("Error in getMonthlyRevenue: " . $e->getMessage());
            return [];
        }
    }
}