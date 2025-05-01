<?php
require_once __DIR__ . "/../../Database/Database.php";

class TotalProfitReportModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new Database('localhost', 'pos-system', 'root', 'PassWord@123!');
            $stmt = $this->db->query("SELECT 1");
            $result = $this->db->single($stmt);
            error_log("Database connection test in TotalProfitReportModel: " . print_r($result, true));
        } catch (Exception $e) {
            error_log("Error in TotalProfitReportModel constructor: " . $e->getMessage());
            die('Error: ' . $e->getMessage());
        }
    }

    public function getTotalProfitReport($startDate, $endDate) {
        $query = "
            SELECT 
                SUM(si.total_price) as total_income,
                SUM(si.quantity * p.cost_price) as total_expenses
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
            error_log("Total Profit Report Query Result (Start: $startDate, End: $endDate): " . print_r($result, true));
            $totalIncome = floatval($result['total_income'] ?? 0);
            $totalExpenses = floatval($result['total_expenses'] ?? 0);
            $totalProfitReport = $totalIncome - $totalExpenses;
            return is_numeric($totalProfitReport) ? $totalProfitReport : 0;
        } catch (Exception $e) {
            error_log("Error in getTotalProfitReport: " . $e->getMessage());
            return 0;
        }
    }

    public function getMonthlyProfitReportData($startDate, $endDate) {
        $query = "
            SELECT 
                DATE_FORMAT(si.sale_date, '%Y-%m') as month,
                SUM(si.total_price) as income,
                SUM(si.quantity * p.cost_price) as expenses
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
            error_log("Monthly Profit Report Data Query Result (Start: $startDate, End: $endDate): " . print_r($results, true));

            $monthlyData = [];
            foreach ($results as $row) {
                $monthName = DateTime::createFromFormat('Y-m', $row['month'])->format('M Y');
                $income = floatval($row['income'] ?? 0);
                $expenses = floatval($row['expenses'] ?? 0);
                $profit = $income - $expenses;

                $monthlyData[] = [
                    'month' => $monthName,
                    'profit' => $profit,
                ];
            }

            $start = new DateTime($startDate);
            $end = new DateTime($endDate);
            $interval = new DateInterval('P1M');
            $dateRange = new DatePeriod($start, $interval, $end->modify('+1 month'));
            $allMonths = [];
            foreach ($dateRange as $date) {
                $monthName = $date->format('M Y');
                $allMonths[$monthName] = [
                    'month' => $monthName,
                    'profit' => 0,
                ];
            }

            foreach ($monthlyData as $data) {
                $allMonths[$data['month']] = $data;
            }

            $monthlyData = array_values($allMonths);
            error_log("Processed Monthly Profit Report Data: " . print_r($monthlyData, true));
            return $monthlyData;
        } catch (Exception $e) {
            error_log("Error in getMonthlyProfitReportData: " . $e->getMessage());
            return [];
        }
    }
}