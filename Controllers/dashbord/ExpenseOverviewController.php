<?php

require_once __DIR__ . "/../BaseController.php";
require_once __DIR__ . "/../../Models/dashbord/ExpenseOverviewModel.php";

class ExpenseOverviewController extends BaseController {
    private $expenseModel;

    public function __construct() {
        $this->expenseModel = new ExpenseOverviewModel();
        if (!$this->expenseModel) {
            die('Error: ExpenseOverviewModel could not be loaded.');
        }
    }

    public function index() {
        $currentYear = date('Y'); // 2025
        $startDate = "$currentYear-01-01";
        $endDate = "$currentYear-12-31";

        $monthlyData = $this->expenseModel->getMonthlyData($startDate, $endDate);
        $totalIncome = $this->expenseModel->getTotalIncome($startDate, $endDate);
        $totalExpenses = $this->expenseModel->getTotalExpenses($startDate, $endDate);
        $totalProfit = $totalIncome - $totalExpenses;

        // Calculate comparison data for the current month vs. the previous month
        $currentMonthStart = date('Y-m-01');
        $currentMonthEnd = date('Y-m-t');
        $previousMonthStart = date('Y-m-01', strtotime('first day of previous month'));
        $previousMonthEnd = date('Y-m-t', strtotime('last day of previous month'));

        $currentMonthIncome = $this->expenseModel->getTotalIncome($currentMonthStart, $currentMonthEnd);
        $previousMonthIncome = $this->expenseModel->getTotalIncome($previousMonthStart, $previousMonthEnd);
        $incomeDifference = $currentMonthIncome - $previousMonthIncome;
        $incomePercentage = $previousMonthIncome > 0 ? round(($incomeDifference / $previousMonthIncome) * 100) : ($currentMonthIncome > 0 ? 100 : 0);

        $currentMonthExpenses = $this->expenseModel->getTotalExpenses($currentMonthStart, $currentMonthEnd);
        $previousMonthExpenses = $this->expenseModel->getTotalExpenses($previousMonthStart, $previousMonthEnd);
        $expensesDifference = $currentMonthExpenses - $previousMonthExpenses;
        $expensesPercentage = $previousMonthExpenses > 0 ? round(($expensesDifference / $previousMonthExpenses) * 100) : ($currentMonthExpenses > 0 ? 100 : 0);

        $currentMonthProfit = $currentMonthIncome - $currentMonthExpenses;
        $previousMonthProfit = $previousMonthIncome - $previousMonthExpenses;
        $profitDifference = $currentMonthProfit - $previousMonthProfit;
        $profitPercentage = $previousMonthProfit != 0 ? round(($profitDifference / abs($previousMonthProfit)) * 100) : ($currentMonthProfit > 0 ? 100 : 0);

        $data = [
            'monthlyData' => $monthlyData,
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'totalProfit' => $totalProfit,
            'comparisonData' => [
                'income' => ['percentage' => $incomePercentage, 'difference' => $incomeDifference],
                'expenses' => ['percentage' => $expensesPercentage, 'difference' => $expensesDifference],
                'profit' => ['percentage' => $profitPercentage, 'difference' => $profitDifference]
            ],
            'currentYear' => $currentYear
        ];

        error_log("Data passed to view: " . print_r($data, true));
        $this->view('dashbord_component/_expenseOverview', $data);
    }

    public function getUpdatedData() {
        $currentYear = date('Y');
        $startDate = "$currentYear-01-01";
        $endDate = "$currentYear-12-31";

        $monthlyData = $this->expenseModel->getMonthlyData($startDate, $endDate);
        $totalIncome = $this->expenseModel->getTotalIncome($startDate, $endDate);
        $totalExpenses = $this->expenseModel->getTotalExpenses($startDate, $endDate);
        $totalProfit = $totalIncome - $totalExpenses;

        // Calculate comparison data
        $currentMonthStart = date('Y-m-01');
        $currentMonthEnd = date('Y-m-t');
        $previousMonthStart = date('Y-m-01', strtotime('first day of previous month'));
        $previousMonthEnd = date('Y-m-t', strtotime('last day of previous month'));

        $currentMonthIncome = $this->expenseModel->getTotalIncome($currentMonthStart, $currentMonthEnd);
        $previousMonthIncome = $this->expenseModel->getTotalIncome($previousMonthStart, $previousMonthEnd);
        $incomeDifference = $currentMonthIncome - $previousMonthIncome;
        $incomePercentage = $previousMonthIncome > 0 ? round(($incomeDifference / $previousMonthIncome) * 100) : ($currentMonthIncome > 0 ? 100 : 0);

        $currentMonthExpenses = $this->expenseModel->getTotalExpenses($currentMonthStart, $currentMonthEnd);
        $previousMonthExpenses = $this->expenseModel->getTotalExpenses($previousMonthStart, $previousMonthEnd);
        $expensesDifference = $currentMonthExpenses - $previousMonthExpenses;
        $expensesPercentage = $previousMonthExpenses > 0 ? round(($expensesDifference / $previousMonthExpenses) * 100) : ($currentMonthExpenses > 0 ? 100 : 0);

        $currentMonthProfit = $currentMonthIncome - $currentMonthExpenses;
        $previousMonthProfit = $previousMonthIncome - $previousMonthExpenses;
        $profitDifference = $currentMonthProfit - $previousMonthProfit;
        $profitPercentage = $previousMonthProfit != 0 ? round(($profitDifference / abs($previousMonthProfit)) * 100) : ($currentMonthProfit > 0 ? 100 : 0);

        $response = [
            'success' => true,
            'monthlyData' => $monthlyData,
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'totalProfit' => $totalProfit,
            'comparisonData' => [
                'income' => ['percentage' => $incomePercentage, 'difference' => $incomeDifference],
                'expenses' => ['percentage' => $expensesPercentage, 'difference' => $expensesDifference],
                'profit' => ['percentage' => $profitPercentage, 'difference' => $profitDifference]
            ],
            'currentYear' => $currentYear
        ];

        error_log("getUpdatedData Response: " . print_r($response, true));
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}