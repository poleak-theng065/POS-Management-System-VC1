<?php
require_once __DIR__ . "/../../Database/Database.php";

class ExpenseOverviewModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new Database('localhost', 'pos-system', 'root', 'PassWord@123!');
            // Test connection
            $stmt = $this->db->query("SELECT 1");
            $this->db->single($stmt);
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception("Failed to initialize database connection");
        }
    }

    public function getDashboardData($year = null) {
        try {
            $currentYear = $year ?? date('Y');
            
            // Get current period (this month)
            $currentStart = date('Y-m-01');
            $currentEnd = date('Y-m-t');
            
            // Get previous period (last month)
            $previousStart = date('Y-m-01', strtotime('-1 month'));
            $previousEnd = date('Y-m-t', strtotime('-1 month'));
            
            // Get data for the entire year
            $yearStart = $currentYear . '-01-01';
            $yearEnd = $currentYear . '-12-31';
            
            // Get all required data
            $totalIncome = $this->getTotalIncome($yearStart, $yearEnd);
            $totalExpenses = $this->getTotalExpenses($yearStart, $yearEnd);
            $monthlyData = $this->getMonthlyData($yearStart, $yearEnd);
            $comparisonData = $this->getComparisonData($currentStart, $currentEnd, $previousStart, $previousEnd);
            
            return [
                'success' => true,
                'totalIncome' => $totalIncome,
                'totalExpenses' => $totalExpenses,
                'totalProfit' => $totalIncome - $totalExpenses,
                'monthlyData' => $monthlyData,
                'comparisonData' => $comparisonData,
                'currentYear' => $currentYear
            ];
            
        } catch (Exception $e) {
            error_log("getDashboardData error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to retrieve dashboard data'
            ];
        }
    }

    public function getTotalIncome($startDate, $endDate) {
        $this->validateDates($startDate, $endDate);
        
        $query = "
            SELECT COALESCE(SUM(total_amount), 0) as total_income
            FROM sales
            WHERE sale_date BETWEEN :start_date AND :end_date
            AND status = 'completed'
        ";

        try {
            $stmt = $this->db->query($query, [
                ':start_date' => $startDate,
                ':end_date' => $endDate
            ]);
            $result = $this->db->single($stmt);
            return (float)$result['total_income'];
        } catch (Exception $e) {
            error_log("getTotalIncome error: " . $e->getMessage());
            throw new Exception("Failed to retrieve income data");
        }
    }

    public function getTotalExpenses($startDate, $endDate) {
        $this->validateDates($startDate, $endDate);
        
        // Debug: Log the actual dates being received
        error_log("getTotalExpenses called with dates: $startDate to $endDate");
        
        $query = "
            SELECT COALESCE(SUM(si.quantity * p.cost_price), 0) AS total_expenses
            FROM sale_items si
            JOIN products p ON si.product_id = p.product_id
            JOIN sales s ON si.sale_id = s.sale_id
            WHERE s.sale_date BETWEEN :start_date AND :end_date
            AND s.status = 'completed'
        ";
    
        try {
            $stmt = $this->db->query($query, [
                ':start_date' => $startDate,
                ':end_date' => $endDate
            ]);
            
            $result = $this->db->single($stmt);
            
            // Debug: Log the raw result
            error_log("Raw expense query result: " . print_r($result, true));
            
            return (float)$result['total_expenses'];
        } catch (Exception $e) {
            error_log("getTotalExpenses error: " . $e->getMessage());
            throw new Exception("Failed to retrieve expenses data");
        }
    }

    public function getMonthlyData($startDate, $endDate) {
        $this->validateDates($startDate, $endDate);
        
        $query = "
            SELECT 
                DATE_FORMAT(s.sale_date, '%Y-%m') as month,
                COALESCE(SUM(s.total_amount), 0) as income,
                COALESCE(SUM(si.quantity * p.cost_price), 0) as expenses
            FROM sales s
            JOIN sale_items si ON s.sale_id = si.sale_id
            JOIN products p ON si.product_id = p.product_id
            WHERE s.sale_date BETWEEN :start_date AND :end_date
            AND s.status = 'completed'
            GROUP BY DATE_FORMAT(s.sale_date, '%Y-%m')
            ORDER BY month ASC
        ";

        try {
            $stmt = $this->db->query($query, [
                ':start_date' => $startDate,
                ':end_date' => $endDate
            ]);
            $results = $this->db->resultSet($stmt);

            $monthlyData = [];
            foreach ($results as $row) {
                $monthName = DateTime::createFromFormat('Y-m', $row['month'])->format('M Y');
                $income = (float)$row['income'];
                $expenses = (float)$row['expenses'];
                
                $monthlyData[] = [
                    'month' => $monthName,
                    'income' => $income,
                    'expenses' => $expenses,
                    'profit' => $income - $expenses,
                ];
            }

            // Fill in missing months with zero values
            $start = new DateTime($startDate);
            $end = new DateTime($endDate);
            $interval = new DateInterval('P1M');
            $period = new DatePeriod($start, $interval, $end);

            $completeMonthlyData = [];
            foreach ($period as $date) {
                $monthKey = $date->format('M Y');
                $found = false;
                
                foreach ($monthlyData as $data) {
                    if ($data['month'] === $monthKey) {
                        $completeMonthlyData[] = $data;
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $completeMonthlyData[] = [
                        'month' => $monthKey,
                        'income' => 0.0,
                        'expenses' => 0.0,
                        'profit' => 0.0
                    ];
                }
            }

            return $completeMonthlyData;
        } catch (Exception $e) {
            error_log("getMonthlyData error: " . $e->getMessage());
            throw new Exception("Failed to retrieve monthly data");
        }
    }

    public function getComparisonData($currentStart, $currentEnd, $previousStart, $previousEnd) {
        $this->validateDates($currentStart, $currentEnd);
        $this->validateDates($previousStart, $previousEnd);
        
        try {
            $currentIncome = $this->getTotalIncome($currentStart, $currentEnd);
            $previousIncome = $this->getTotalIncome($previousStart, $previousEnd);
            $incomeDifference = $currentIncome - $previousIncome;
            $incomePercentage = $previousIncome != 0 ? ($incomeDifference / abs($previousIncome)) * 100 : ($currentIncome != 0 ? 100 : 0);

            $currentExpenses = $this->getTotalExpenses($currentStart, $currentEnd);
            $previousExpenses = $this->getTotalExpenses($previousStart, $previousEnd);
            $expensesDifference = $currentExpenses - $previousExpenses;
            $expensesPercentage = $previousExpenses != 0 ? ($expensesDifference / abs($previousExpenses)) * 100 : ($currentExpenses != 0 ? 100 : 0);

            return [
                'income' => [
                    'current' => $currentIncome,
                    'previous' => $previousIncome,
                    'difference' => $incomeDifference,
                    'percentage' => round($incomePercentage)
                ],
                'expenses' => [
                    'current' => $currentExpenses,
                    'previous' => $previousExpenses,
                    'difference' => $expensesDifference,
                    'percentage' => round($expensesPercentage)
                ],
                'profit' => [
                    'current' => $currentIncome - $currentExpenses,
                    'previous' => $previousIncome - $previousExpenses,
                    'difference' => ($currentIncome - $currentExpenses) - ($previousIncome - $previousExpenses),
                    'percentage' => $previousIncome - $previousExpenses != 0 
                        ? round((($currentIncome - $currentExpenses) - ($previousIncome - $previousExpenses)) / 
                          abs($previousIncome - $previousExpenses) * 100)
                        : ($currentIncome - $currentExpenses != 0 ? 100 : 0)
                ]
            ];
        } catch (Exception $e) {
            error_log("getComparisonData error: " . $e->getMessage());
            throw new Exception("Failed to generate comparison data");
        }
    }

    private function validateDates($startDate, $endDate) {
        if (!strtotime($startDate) || !strtotime($endDate)) {
            throw new InvalidArgumentException("Invalid date format");
        }
        
        // Convert to DateTime objects for comparison
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        
        if ($start > $end) {
            throw new InvalidArgumentException("Start date cannot be after end date");
        }
        
        // Additional check for reasonable date ranges
        $currentYear = date('Y');
        if ($start->format('Y') < 2000 || $end->format('Y') > ($currentYear + 1)) {
            throw new InvalidArgumentException("Date range out of reasonable bounds");
        }
    }
}