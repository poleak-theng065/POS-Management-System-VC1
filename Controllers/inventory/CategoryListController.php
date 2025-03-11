<?php
require_once './Models/CategoryModel.php';
require_once './Database/Database.php';

class CategoryListController extends BaseController
{
    private $model;

    // Constructor to initialize the model
    public function __construct()
    {
        $this->model = new CategoryModel();  // Instantiate the model here
    }

    // Show all categories
    public function index()
    {
        $categories = $this->model->getCategories();
        $this->view('category/category_list', ['categories' => $categories]);
    }


    // Delete a category from the database
    // In CategoryListController.php
    public function destroy()
{
    // Ensure the id is passed in the POST data
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $this->model->deleteCategory($id); // Delete category using model method
    }
    
    // After deletion, redirect to category list
    $this->redirect('/category_list');
}


}

