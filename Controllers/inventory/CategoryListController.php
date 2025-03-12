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
                'name' => !empty($_POST['name']) ? $_POST['name'] : null,
                'model' => !empty($_POST['model']) ? $_POST['model'] : null,
                'type' => !empty($_POST['type']) ? $_POST['type'] : null,
                'description' => !empty($_POST['description']) ? $_POST['description'] : null,
            ];

            if (empty($data['name']) || empty($data['model']) || empty($data['type'])) {
                die('Error: Name, Model, and Type fields are required.');
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
                'name' => $_POST['name'],
                'model' => $_POST['model'],
                'type' => $_POST['type'],
                'description' => $_POST['description']
            ];

            $this->iteam->updateCategory($id, $data);
            $this->redirect('/category_list');
        }
    }
}
