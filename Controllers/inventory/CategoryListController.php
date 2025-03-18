<?php
require_once ("Models/inventory/CategoryModel.php");
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
        $products = $this->iteam->getProducts();
        $this->view("inventory/category_list/category_list", ["categories" => $categories, "products" => $products]);
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
                'description' => !empty($_POST['description']) ? $_POST['description'] : null,
            ];

            if (empty($data['name']) || empty($data['description'])) {
                die('Error: name fields are required.');
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
            if ($id === null && isset($_POST['category_id'])) {
                $id = $_POST['category_id'];
            }

            if (!$id) {
                die('Error: No category ID provided.');
            }

            $data = [
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
            ];

            $this->iteam->updateCategory($id, $data);
            $this->redirect('/category_list');
        }
    }

    public function destroy()
    {
        if (isset($_POST['category_id'])) {
            $id = $_POST['category_id'];
            $this->iteam->deleteCategory($id);
            $this->redirect('/category_list');
        } else {
            die('Error: No category ID provided.');
        }
    }
}
