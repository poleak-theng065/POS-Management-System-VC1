<?php
require_once "Models/ProductModel.php";

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

            foreach ($data as $key => $value) {
                if ($value === null && $key !== 'description') {
                    $_SESSION['error'] = "Error: All required fields must be filled.";
                    $this->redirect('/product_list'); 
                    return;
                }
            }

            if ($this->iteam->createProduct($data)) {
                $_SESSION['success'] = "Product added successfully!";
            } else {
                $_SESSION['error'] = "Error: Unable to add product.";
            }

            $this->redirect('/product_list'); 
        }
    }

    function edit($id)
    {
        $category = $this->iteam->getProduct($id);
        $this->view('inventory/product_list', ['products' => $category]);
    }

    public function update($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($id === null && isset($_POST['product_id'])) {
                $id = intval($_POST['product_id']);
            }

            if (!$id) {
                $_SESSION['error'] = "Error: No product ID provided.";
                $this->redirect('/inventory/product_list');
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
                    $this->redirect('/inventory/product_list');
                    return;
                }
            }

            if ($this->iteam->updateProduct($id, $data)) {
                $_SESSION['success'] = "Product updated successfully!";
            } else {
                $_SESSION['error'] = "Error: Unable to update product.";
            }

            $this->redirect('/product_list');
        }
    }

    public function destroy()
    {
        if (isset($_POST['product_id'])) {
            $id = $_POST['product_id'];
            $this->iteam->deleteProduct($id);
            $this->redirect('/product_list');
        } else {
            die('Error: No product ID provided.');
        }
    }
}
