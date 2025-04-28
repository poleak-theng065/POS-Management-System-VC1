<?php

require_once __DIR__ . "/../BaseController.php";
require_once __DIR__ . "/../../Models/dashbord/TotalRevenueModel.php";

class TotalRevenueController extends BaseController {
    private $totalRevenueModel;

    public function __construct() {
        $this->totalRevenueModel = new TotalRevenueModel();
    }

    public function index() {
        $currentYear = date('Y'); // 2025 as of April 26, 2025
        $startDate = "$currentYear-01-01";
        $endDate = "$currentYear-12-31";

        $monthlyData = $this->totalRevenueModel->getMonthlyRevenue($startDate, $endDate);
        $totalRevenue = $this->totalRevenueModel->getYearlyRevenue($startDate, $endDate);

        $data = [
            'monthlyData' => $monthlyData,
            'totalRevenue' => $totalRevenue,
            'currentYear' => $currentYear
        ];

        error_log("Data passed to view in TotalRevenueController: " . print_r($data, true));
        $this->view('dashbord_component/_totalRevenue', $data);
    }

    public function getUpdatedData() {
        $currentYear = date('Y');
        $startDate = "$currentYear-01-01";
        $endDate = "$currentYear-12-31";

        $monthlyData = $this->totalRevenueModel->getMonthlyRevenue($startDate, $endDate);
        $totalRevenue = $this->totalRevenueModel->getYearlyRevenue($startDate, $endDate);

        $response = [
            'success' => true,
            'monthlyData' => $monthlyData,
            'totalRevenue' => $totalRevenue,
            'currentYear' => $currentYear
        ];

        error_log("getUpdatedData Response in TotalRevenueController: " . print_r($response, true));
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}