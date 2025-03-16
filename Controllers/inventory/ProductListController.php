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
        $this->view("inventory/product_list/product_list", ["products" => $products]);
    }

    public function create()
    {
        $this->view("inventory/product_list");
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => !empty($_POST['name']) ? $_POST['name'] : null,
                'barcode' => !empty($_POST['barcode']) ? $_POST['barcode'] : null,
                'brand' => !empty($_POST['brand']) ? $_POST['brand'] : null,
                'model' => !empty($_POST['model']) ? $_POST['model'] : null,
                'type' => !empty($_POST['type']) ? $_POST['type'] : null,
                'status' => !empty($_POST['status']) ? $_POST['status'] : null,
                'stock_quantity' => !empty($_POST['stock_quantity']) ? $_POST['stock_quantity'] : null,
                'unit_price' => !empty($_POST['unit_price']) ? $_POST['unit_price'] : null,
                'cost_price' => !empty($_POST['cost_price']) ? $_POST['cost_price'] : null,
            ];

            if (empty($data['name']) || empty($data['barcode']) || empty($data['brand']) || empty($data['model']) || empty($data['type']) || empty($data['status']) || empty($data['stock_quantity']) || empty($data['unit_price']) || empty($data['cost_price'])) {
                die('Error: All fields are required.');
            }

            $this->iteam->createProduct($data);
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
                $id = $_POST['product_id'];
            }

            if (!$id) {
                die('Error: No product ID provided.');
            }

            $data = [
                'name' => $_POST['name'] ?? null,
                'barcode' => $_POST['barcode'] ?? null,
                'brand' => $_POST['brand'] ?? null,
                'model' => $_POST['model'] ?? null,
                'type' => $_POST['type'] ?? null,
                'status' => $_POST['status'] ?? null,
                'stock_quantity' => $_POST['stock_quantity'] ?? null, // Add stock_quantity
            ];

            $this->iteam->updateProduct($id, $data);
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
