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
                'Quantity_Product' => !empty($_POST['Quantity_Product']) ? $_POST['Quantity_Product'] : null,
                'Model_Product' => !empty($_POST['Model_Product']) ? $_POST['Model_Product'] : null,
                'Type_Product' => !empty($_POST['Type_Product']) ? $_POST['Type_Product'] : null,
                'Sell_Price' => !empty($_POST['Sell_Price']) ? $_POST['Sell_Price'] : null,
            ];

            if (empty($data['Category_Name']) || empty($data['Quantity_Product']) || empty($data['Type_Product'])|| empty($data['Sell_Price'])) {
                die('Error: Name, Model, Type, and P fields are required.');
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
            if ($id === null && isset($_GET['id'])) {
                $id = $_GET['id'];  
            }

            if (!$id) {
                die('Error: No category ID provided.');
            }

            $data = [
                'Category_Name' => $_POST['Category_Name'],
                'Quantity_Product' => $_POST['Quantity_Product'],
                'Model_Product' => $_POST['Model_Product'],
                'Type_Product' => $_POST['Type_Product'],
                'Sell_Price' => $_POST['Sell_Price']
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
