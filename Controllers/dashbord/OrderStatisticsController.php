<?php
require_once "Controllers/BaseController.php";
require_once "Models/dashbord/OrderStatisticsModel.php";

class OrderStatisticsController extends BaseController
{
    private $orderStatisticsModel;

    public function __construct()
    {
        $this->orderStatisticsModel = new OrderStatisticsModel();
    }

    public function getOrderStatisticsData()
    {
        try {
            $categories = $this->orderStatisticsModel->getCategoriesWithProductQuantities();
            $totalProducts = $this->orderStatisticsModel->getTotalProductQuantity();

            // Log for debugging
            error_log("Categories in OrderStatisticsController: " . print_r($categories, true));
            error_log("Total Products in OrderStatisticsController: " . $totalProducts);

            // For AJAX route, return JSON
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'categories' => $categories,
                    'totalProducts' => $totalProducts
                ]);
                exit;
            }

            return [
                "categories" => $categories,
                "totalProducts" => $totalProducts
            ];
        } catch (Exception $e) {
            error_log("Error in getOrderStatisticsData: " . $e->getMessage());
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'error' => 'Failed to fetch order statistics data'
                ]);
                exit;
            }
            return [
                "categories" => [],
                "totalProducts" => 0
            ];
        }
    }

    public function index()
    {
        $data = $this->getOrderStatisticsData();
        $this->view("dashboard/dashboard_component/orderStatistics", $data);
    }
}