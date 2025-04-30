<?php

require_once __DIR__ . "/../BaseController.php";
require_once __DIR__ . "/../../Models/dashbord/TotalProfitReportModel.php";

class TotalProfitReportController extends BaseController {
   
    private $profitModel;

    public function __construct() {
        $this->profitModel = new TotalProfitReportModel();
        if (!$this->profitModel) {
            error_log("Failed to instantiate TotalProfitReportModel in TotalProfitReportController.");
            die('Error: TotalProfitReportModel could not be loaded.');
        }
    }

    public function index() {
        // Get the current year dynamically
        $currentYear = date('Y'); // 2025 as of the current date (April 26, 2025)
        $startDate = "$currentYear-01-01";
        $endDate = "$currentYear-12-31";

        $monthlyData = $this->profitModel->getMonthlyProfitReportData($startDate, $endDate);
        $totalProfit = $this->profitModel->getTotalProfitReport($startDate, $endDate);

        if (empty($monthlyData)) {
            error_log("No monthly data retrieved for TotalProfitReportController.");
            $monthlyData = [];
        }

        $data = [
            'monthlyData' => $monthlyData,
            'totalProfitReport' => $totalProfit,
            'currentYear' => $currentYear // Pass the current year to the view
        ];

        error_log("Data passed to view in TotalProfitReportController: " . print_r($data, true));
        $this->view('dashbord_component/_totalProfitReport', $data);
    }

    public function getUpdatedData() {
        // Get the current year dynamically
        $currentYear = date('Y');
        $startDate = "$currentYear-01-01";
        $endDate = "$currentYear-12-31";

        $monthlyData = $this->profitModel->getMonthlyProfitReportData($startDate, $endDate);
        $totalProfit = $this->profitModel->getTotalProfitReport($startDate, $endDate);

        $response = [
            'success' => true,
            'monthlyData' => $monthlyData,
            'totalProfitReport' => $totalProfit,
            'currentYear' => $currentYear
        ];

        error_log("getUpdatedData Response in TotalProfitReportController: " . print_r($response, true));
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}