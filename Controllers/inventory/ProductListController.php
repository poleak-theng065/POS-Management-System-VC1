<?php
require_once ("Models/inventory/ProductModel.php");

class ProductListController extends BaseController
{
    public function product_list()
    {
        $this->view('inventory/product_list/product_list');
    }

    private $iteam;
    public function __construct()
    {
        $this->iteam = new ProductModel();
    }

    public function index()
    {
        $products = $this->iteam->getProducts();
        $categories = $this->iteam->getCategories();
        $this->view("inventory/product_list/product_list", ["products" => $products, "categories" => $categories]);
    }

    public function create()
    {
        $categories = $this->iteam->getCategories(); 
        $this->view("inventory/product_list/create", ["categories" => $categories]); 
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'] ?? null,
                'barcode' => $_POST['barcode'] ?? null,
                'brand' => $_POST['brand'] ?? null,
                'model' => $_POST['model'] ?? null,
                'type' => $_POST['type'] ?? null,
                'status' => $_POST['status'] ?? null,
                'stock_quantity' => $_POST['stock_quantity'] ?? null,
                'unit_price' => $_POST['unit_price'] ?? null,
                'cost_price' => $_POST['cost_price'] ?? null,
                'category_id' => $_POST['category_id'] ?? null,
                'description' => $_POST['description'] ?? null,
                
            ];

            if (isset($_FILES['image']) && isset($_FILES['image']['name']) && isset($_FILES['image']['tmp_name'])) {
                $image = $_FILES['image']['name'];

                // Move the uploaded file to a specific directory
                move_uploaded_file($_FILES['image']['tmp_name'], "assets/img/upload/" . $image);
            } else {
                $image = null; // Handle the case where no image is uploaded
            }

            foreach ($data as $key => $value) {
                if ($value === null && $key !== 'description') {
                    $_SESSION['error'] = "Error: All required fields must be filled.";
                    $this->redirect('/product_list');
                    return;
                }
            }

            if ($this->iteam->createProduct($data, $image)) {
                echo "<script>
                        console.log('Setting status: success');
                        localStorage.setItem('productStatus', 'success');
                        window.location.href = '/product_list';
                    </script>";
            } else {
                echo "<script>
                        console.log('Setting status: fail');
                        localStorage.setItem('productStatus', 'fail');
                        window.location.href = '/product_list';
                    </script>";
            }
        }
    }

    public function edit($id)
    {
        $product = $this->iteam->getProduct($id);

        if (!$product) {
            $_SESSION['error'] = "Product not found!";
            $this->redirect('/product_list');
            return;
        }

        $categories = $this->iteam->getCategories(); 
        $this->view('inventory/product_list/edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($id === null && isset($_POST['product_id'])) {
                $id = intval($_POST['product_id']);
            }

            if (!$id) {
                $_SESSION['error'] = "Error: No product ID provided.";
                $this->redirect('/product_list');
                return;
            }

            $data = [
                'name' => isset($_POST['name']) ? trim(htmlspecialchars($_POST['name'])) : null,
                'barcode' => isset($_POST['barcode']) ? trim(htmlspecialchars($_POST['barcode'])) : null,
                'brand' => isset($_POST['brand']) ? trim(htmlspecialchars($_POST['brand'])) : null,
                'model' => isset($_POST['model']) ? trim(htmlspecialchars($_POST['model'])) : null,
                'type' => isset($_POST['type']) ? trim(htmlspecialchars($_POST['type'])) : null,
                'status' => isset($_POST['status']) ? trim(htmlspecialchars($_POST['status'])) : null,
                'stock_quantity' => isset($_POST['stock_quantity']) ? intval($_POST['stock_quantity']) : null,
                'category_id' => isset($_POST['category_id']) ? intval($_POST['category_id']) : null,
                'description' => isset($_POST['description']) ? trim(htmlspecialchars($_POST['description'])) : null,
            ];

            foreach ($data as $key => $value) {
                if ($value === null && $key !== 'description') {
                    $_SESSION['error'] = "Error: All required fields must be filled.";
                    $this->redirect('/product_list');
                    return;
                }
            }

            if ($this->iteam->updateProduct($id, $data)) {
                echo "<script>
                        console.log('Setting status: success');
                        localStorage.setItem('productUpdateStatus', 'success');
                        window.location.href = '/product_list';
                    </script>";
            } else {
                echo "<script>
                        console.log('Setting status: fail');
                        localStorage.setItem('productUpdateStatus', 'fail');
                        window.location.href = '/product_list';
                    </script>";
            }

        }
    }

    public function destroy()
    {
        if (isset($_POST['product_id'])) {
            $id = $_POST['product_id'];
            $result = $this->iteam->deleteProduct($id);
            if ($result === true) {
                echo "<script>
                        console.log('Setting status: success');
                        localStorage.setItem('productDeleteStatus', 'success');
                        window.location.href = '/product_list';
                    </script>";
            } else {
                echo "<script>
                        console.log('Setting status: fail');
                        localStorage.setItem('productDeleteStatus', 'fail');
                        window.location.href = '/product_list';
                    </script>";
            }
        } else {
            die('Error: No product ID provided.');
        }
    }
}
