<?php
require_once "Models/CategoryModel.php";

class CategoryListController extends BaseController
{
    public function category_list()
    {
        $this->view('inventory/category_list/category_list');
    }

    private $iteam;
    public function __construct()
    {
        $this->iteam = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->iteam->getCategories();
        $this->view("inventory/category_list/category_list", ["categories" => $categories]);
    }

    public function create()
    {
        $this->view("inventory/category_list");
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Category_Name' => !empty($_POST['Category_Name']) ? $_POST['Category_Name'] : null,
                'Model_Product' => !empty($_POST['Model_Product']) ? $_POST['Model_Product'] : null,
                'Type_Product' => !empty($_POST['Type_Product']) ? $_POST['Type_Product'] : null,
            ];

            if (empty($data['Category_Name']) || empty($data['Model_Product']) || empty($data['Type_Product'])) {
                die('Error: Category_Name, Model_Product, and Type_Product fields are required.');
            }

            $this->iteam->createCategory($data);
            $this->redirect('/category_list');
        }
    }

    function edit($id)
    {
        $category = $this->iteam->getCategory($id);
        $this->view('inventory/category_list', ['category' => $category]);
    }

    public function update($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($id === null && isset($_POST['Category_ID'])) {
                $id = $_POST['Category_ID'];
            }

            if (!$id) {
                die('Error: No category ID provided.');
            }

            $data = [
                'Category_Name' => $_POST['Category_Name'] ?? null,
                'Model_Product' => $_POST['Model_Product'] ?? null,
                'Type_Product' => $_POST['Type_Product'] ?? null,
            ];

            $this->iteam->updateCategory($id, $data);
            $this->redirect('/category_list');
        }
    }

    public function destroy()
    {
        if (isset($_POST['Category_ID'])) {
            $id = $_POST['Category_ID'];
            $this->iteam->deleteCategory($id);
            $this->redirect('/category_list');
        } else {
            die('Error: No category ID provided.');
        }
    }
}
