<?php
session_start(); // Start the session at the top

require_once './Models/CategoryModel.php';
require_once './Database/Database.php';
require_once './Controllers/BaseController.php';

class CategoryListController extends BaseController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();

        // Ensure CSRF token exists in session
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    public function index()
{
    $categories = $this->categoryModel->getCategories();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    // Debug: Log the data being passed
    error_log("Categories: " . print_r($categories, true));
    error_log("CSRF Token in index: " . $_SESSION['csrf_token']);
    $this->view('category/category_list', [
        'categories' => $categories,
        'csrf_token' => $_SESSION['csrf_token']
    ]);
}

    public function destroy()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

            // Debugging: Log the tokens for comparison
            error_log("POST CSRF Token: " . ($_POST['csrf_token'] ?? 'Not set'));
            error_log("Session CSRF Token: " . ($_SESSION['csrf_token'] ?? 'Not set'));

            // Validate CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                http_response_code(403);
                echo "Invalid CSRF token.";
                // More debugging output
                echo "<br>POST Token: " . htmlspecialchars($_POST['csrf_token'] ?? 'Not set');
                echo "<br>Session Token: " . htmlspecialchars($_SESSION['csrf_token'] ?? 'Not set');
                exit();
            }

            if ($this->categoryModel->deleteCategory($id)) {
                header("Location: /category_list?success=1");
                exit();
            } else {
                header("Location: /category_list?error=1");
                exit();
            }
        }

        http_response_code(400);
        echo "Invalid request";
        exit();
    }
}