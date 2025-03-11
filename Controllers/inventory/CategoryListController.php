<?php
require_once "Models/CategoryModel.php";

class CategoryListController extends BaseController
{
    public function category_list()
    {
        $this->view('category/category_list');
    }


    private $iteam;
    public function __construct()
    {
        $this->iteam = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->iteam->getCategories();

        $this->view("category/category_list", ["categories" => $categories]);
    }



    public function create()
    {
        $this->view("category/create");
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'model' => $_POST['model'],
                'type' => $_POST['type'],
                'description' => $_POST['description']
            ];

            $this->iteam->createCategory($data);
            $this->redirect('/category');
        }
    }

    function edit($id)
    {
        $category = $this->iteam->getCategory($id);
        $this->view('category/edit', ['category' => $category]);
    }


    function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'model' => $_POST['model'],
                'type' => $_POST['type'],
                'description' => $_POST['description']
            ];

            $this->iteam->updateCategory($id, $data);

            // Return a JSON response
            echo json_encode([
                'success' => true,
                'id' => $id,
                'name' => $data['name']  // You can send other updated data as needed
            ]);
            exit;  // Ensure the script stops after sending the response
        }
    }


    // function destroy($id)
    // {
    //     $this->iteam->deleteCategory($id);
    //     $this->redirect('/category');
    // }
}
