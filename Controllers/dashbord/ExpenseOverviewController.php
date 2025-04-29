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
            $this->view('dashbord_component/_expenseOverview', $data);
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    public function getUpdatedData() {
        try {
            // Get year from request or use current year
            $year = $_GET['year'] ?? date('Y');
            
            // Validate year (must be 4 digits between 2000-2099)
            if (!preg_match('/^20\d{2}$/', $year)) {
                throw new InvalidArgumentException("Invalid year format");
            }

            $data = $this->getFinancialData($year);
            
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
            // Validate year first
            if (!is_numeric($year)) {
                throw new InvalidArgumentException("Invalid year format");
            }
            
            // Set date ranges properly
            $startDate = "$year-01-01";
            $endDate = "$year-12-31";
            
            // Debug: Log the dates being used
            error_log("Fetching data for period: $startDate to $endDate");
            
            // Get monthly data first
            $monthlyData = $this->expenseModel->getMonthlyData($startDate, $endDate);
            
            // Calculate current month comparison data
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
            
            // Calculate totals from monthly data
            $totalIncome = array_sum(array_column($monthlyData, 'income'));
            $totalExpenses = array_sum(array_column($monthlyData, 'expenses'));
            $totalProfit = $totalIncome - $totalExpenses;
    
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