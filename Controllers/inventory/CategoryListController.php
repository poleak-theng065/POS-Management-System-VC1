<?php
require_once './Models/CategoryModel.php';
require_once './Database/Database.php';

class CategoryListController extends BaseController
{
    private $categoryModel;

    // Constructor to initialize the CategoryModel
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    // Display a list of all categories
    public function index()
    {
        // Fetch all categories from the model
        $categories = $this->categoryModel->getCategories();

        // Pass the categories data to the view
        $this->view('category/category_list', ['categories' => $categories]);
    }

    // Handle the deletion of a category
    public function category_delete($id)
    {
        // Delete the category from the database
        $this->categoryModel->deleteCategory($id);

        // Redirect to the category list page after deletion
        header("Location: /category/category_list");
        exit();
    }
}
