<?php
require_once __DIR__ . "/../../Database/Database.php";

class ExpenseOverviewModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new Database('localhost', 'pos-system', 'root', '');
            $stmt = $this->db->query("SELECT 1");
            $result = $this->db->single($stmt);
            error_log("Database connection test in ExpenseOverviewModel: " . print_r($result, true));
        } catch (Exception $e) {
            error_log("Error in ExpenseOverviewModel constructor: " . $e->getMessage());
            die('Error: ' . $e->getMessage());
        }
    }

    public function getTotalIncome($startDate, $endDate) {
        $query = "
            SELECT SUM(si.total_price) as total_income
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
            error_log("Total Income Query Result (Start: $startDate, End: $endDate): " . print_r($result, true));
            if (!$result || !isset($result['total_income'])) {
                error_log("No income data found for range $startDate to $endDate");
                return 0;
            }
            $totalIncome = $result['total_income'] ?? 0;
            return floatval($totalIncome);
        } catch (Exception $e) {
            error_log("Error in getTotalIncome: " . $e->getMessage());
            return 0;
        }
    }

    public function getTotalExpenses($startDate, $endDate) {
        $query = "
            SELECT SUM(si.quantity * p.cost_price) as total_expenses
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
            error_log("Total Expenses Query Result (Start: $startDate, End: $endDate): " . print_r($result, true));
            if (!$result || !isset($result['total_expenses'])) {
                error_log("No expenses data found for range $startDate to $endDate");
                return 0;
            }
            $totalExpenses = $result['total_expenses'] ?? 0;
            return floatval($totalExpenses);
        } catch (Exception $e) {
            error_log("Error in getTotalExpenses: " . $e->getMessage());
            return 0;
        }
    }

    public function getMonthlyData($startDate, $endDate) {
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
            error_log("Monthly Data Query Result (Start: $startDate, End: $endDate): " . print_r($results, true));

            $monthlyData = [];
            foreach ($results as $row) {
                $monthName = DateTime::createFromFormat('Y-m', $row['month'])->format('M Y');
                $income = floatval($row['income'] ?? 0);
                $expenses = floatval($row['expenses'] ?? 0);
                $profit = $income - $expenses;

                $monthlyData[] = [
                    'month' => $monthName,
                    'income' => $income,
                    'expenses' => $expenses,
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
                    'income' => 0,
                    'expenses' => 0,
                    'profit' => 0,
                ];
            }

            foreach ($monthlyData as $data) {
                $allMonths[$data['month']] = $data;
            }

            $monthlyData = array_values($allMonths);
            error_log("Processed Monthly Data: " . print_r($monthlyData, true));
            return $monthlyData;
        } catch (Exception $e) {
            error_log("Error in getMonthlyData: " . $e->getMessage());
            return [];
        }
    }
}