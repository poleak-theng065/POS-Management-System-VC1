<?php
require_once "BaseController.php";
require_once "Models/CategoryModel.php";

class CategoryController extends BaseController
{

    private $iteam;
    public function __construct()
    {
        $this->iteam = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->iteam->getCategories();
        
        $this->view("inventory/category_list", ["categories" => $categories]);
    }



    public function create()
    {
        $this->view("category/create");
    }

   

}
