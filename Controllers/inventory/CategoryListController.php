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

    public function store(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize inputs
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
    
            // Validate required fields
            if (empty($name) || empty($description)) {
                echo "<script>
                        console.log('Setting status: fail');
                        localStorage.setItem('formStatus', 'fail');
                        window.location.href = '/category_list';
                    </script>";
                exit;
            }
    
            // Attempt to create category
            $result = $this->iteam->createCategory([
                'name' => $name,
                'description' => $description
            ]);
    
            // Handle response
            if ($result === true) {
                echo "<script>
                        console.log('Setting status: success');
                        localStorage.setItem('formStatus', 'success');
                        window.location.href = '/category_list';
                    </script>";
            } elseif ($result === 'Error: Duplicate entry.') {
                echo "<script>
                        console.log('Setting status: duplicate');
                        localStorage.setItem('formStatus', 'duplicate');
                        window.location.href = '/category_list';
                    </script>";
            } else {
                echo "<script>
                        console.log('Setting status: fail');
                        localStorage.setItem('formStatus', 'fail');
                        window.location.href = '/category_list';
                    </script>";
            }
            exit;
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

            $update = $this->iteam->updateCategory($id, $data);
            if ($update === true) {
                echo "<script>
                        console.log('Setting status: success');
                        localStorage.setItem('updateStatus', 'success');
                        window.location.href = '/category_list';
                    </script>";
            } else if ($update === 'Error: Duplicate entry.') {
                echo "<script>
                        console.log('Setting status: duplicate');
                        localStorage.setItem('updateStatus', 'duplicate');
                        window.location.href = '/category_list';
                    </script>";
            }  else {
                echo "<script>
                        console.log('Setting status: fail');
                        localStorage.setItem('updateStatus', 'fail');
                        window.location.href = '/category_list';
                    </script>";
            }
        }
    }

    public function destroy()
    {
        if (isset($_POST['category_id'])) {
            $id = $_POST['category_id'];
            $result = $this->iteam->deleteCategory($id);
            
            if ($result === true) {
                echo "<script>
                        console.log('Setting status: success');
                        localStorage.setItem('deleteStatus', 'success');
                        window.location.href = '/category_list';
                    </script>";
            } else {
                echo "<script>
                        console.log('Setting status: fail');
                        localStorage.setItem('deleteStatus', 'fail');
                        window.location.href = '/category_list';
                    </script>";
            }
        } else {
            die('Error: No category ID provided.');
        }
    }
}
