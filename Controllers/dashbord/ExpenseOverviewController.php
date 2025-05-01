<?php
require_once __DIR__ . "/../BaseController.php";
require_once __DIR__ . "/../../Models/dashbord/ExpenseOverviewModel.php";

class ExpenseOverviewController extends BaseController {
    private $expenseModel;

    public function __construct() {
        try {
            $this->expenseModel = new ExpenseOverviewModel();
        } catch (Exception $e) {
            $this->handleError("Failed to initialize model: " . $e->getMessage());
        }
    }

    public function index() {
        try {
            $currentYear = date('Y');
            $data = $this->getFinancialData($currentYear);
            
            // Debug output
            error_log("Controller index data: " . print_r([
                'hasIncome' => isset($data['totalIncome']),
                'hasExpenses' => isset($data['totalExpenses']),
                'hasProfit' => isset($data['totalProfit'])
            ], true));
            
            $this->view('dashbord_component/_expenseOverview', $data);
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    public function getUpdatedData() {
        try {
            $year = $_GET['year'] ?? date('Y');
            
            if (!preg_match('/^20\d{2}$/', $year)) {
                throw new InvalidArgumentException("Invalid year format");
            }

            $data = $this->getFinancialData($year);
            
            // Debug output
            error_log("AJAX response data: " . print_r([
                'income' => $data['totalIncome'],
                'expenses' => $data['totalExpenses'],
                'profit' => $data['totalProfit']
            ], true));

            $this->jsonResponse([
                'success' => true,
                'monthlyData' => $data['monthlyData'],
                'totalIncome' => $data['totalIncome'],
                'totalExpenses' => $data['totalExpenses'],
                'totalProfit' => $data['totalProfit'],
                'comparisonData' => $data['comparisonData'],
                'currentYear' => $data['currentYear']
            ]);
            
        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function getFinancialData($year) {
        try {
            if (!is_numeric($year)) {
                throw new InvalidArgumentException("Invalid year format");
            }
            
            $startDate = "$year-01-01";
            $endDate = "$year-12-31";
            
            // Get all data in one place for consistency
            $monthlyData = $this->expenseModel->getMonthlyData($startDate, $endDate);
            
            // Calculate totals directly from monthly data for consistency
            $totalIncome = array_reduce($monthlyData, fn($sum, $month) => $sum + $month['income'], 0);
            $totalExpenses = array_reduce($monthlyData, fn($sum, $month) => $sum + $month['expenses'], 0);
            $totalProfit = $totalIncome - $totalExpenses;

            // Get comparison data
            $currentMonthStart = date('Y-m-01');
            $currentMonthEnd = date('Y-m-t');
            $previousMonthStart = date('Y-m-01', strtotime('first day of previous month'));
            $previousMonthEnd = date('Y-m-t', strtotime('last day of previous month'));

            $comparisonData = $this->expenseModel->getComparisonData(
                $currentMonthStart, 
                $currentMonthEnd,
                $previousMonthStart,
                $previousMonthEnd
            );

            return [
                'monthlyData' => $monthlyData,
                'totalIncome' => $totalIncome,
                'totalExpenses' => $totalExpenses,
                'totalProfit' => $totalProfit,
                'comparisonData' => $comparisonData,
                'currentYear' => $year
            ];
            
        } catch (Exception $e) {
            error_log("getFinancialData error: " . $e->getMessage());
            throw $e;
        }
    }

    private function jsonResponse($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    private function handleError($message, $statusCode = 500) {
        error_log("ExpenseOverview Error: " . $message);
        
        if ($this->isAjaxRequest()) {
            $this->jsonResponse([
                'success' => false,
                'message' => $message
            ], $statusCode);
        } else {
            $this->view('error', [
                'message' => $message,
                'statusCode' => $statusCode
            ]);
            exit;
        }
    }

    private function isAjaxRequest() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}