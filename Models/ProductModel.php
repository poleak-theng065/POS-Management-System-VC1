<?php
require_once "Database/Database.php";
class ProductModel
{
    private $pdo;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "inventorydb";
        $username = "root";
        $password = "";

        $this->pdo = new Database($host, $dbname, $username, $password);
    }

    public function getCategories()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM categories");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error fetching categories: " . $e->getMessage();
            return [];
        }
    }
      
    function getProducts()
    {
        $products = $this->pdo->query("
        SELECT products.*, 
               IFNULL(categories.name, '') AS category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.category_id
        ORDER BY products.product_id DESC
    ");
        return $products->fetchAll();
    }

    function createProduct($data)
    {
        $sql = 'INSERT INTO products (name, barcode, brand, model, type, status, stock_quantity, unit_price, cost_price, category_id) 
                VALUES (:name, :barcode, :brand, :model, :type, :status, :stock_quantity, :unit_price, :cost_price, :category_id)';
    
        $stmt = $this->pdo->query($sql, [
            ':name' => $data['name'],
            ':barcode' => $data['barcode'],
            ':brand' => $data['brand'],
            ':model' => $data['model'],
            ':type' => $data['type'],
            ':status' => $data['status'],
            ':stock_quantity' => $data['stock_quantity'],
            ':unit_price' => $data['unit_price'],
            ':cost_price' => $data['cost_price'],
            ':category_id' => $data['category_id'],
        ]);
    
        return $stmt ? true : false;
    }
    
    function getProduct($id)
    {
        $stmt = $this->pdo->query(
            'SELECT * FROM products WHERE product_id = :product_id',
            ['product_id' => $id]
        );
        $category = $stmt->fetch();
        return $category;
    }

    function updateProduct($id, $data)
    {
        if (!$id) {
            die('Error: No product ID provided.');
        }

        $sql = 'UPDATE products 
                SET name = :name, 
                    barcode = :barcode, 
                    brand = :brand, 
                    model = :model, 
                    type = :type, 
                    status = :status,
                    stock_quantity = :stock_quantity,
                    unit_price = :unit_price,
                    cost_price = :cost_price,
                    category_id = :category_id
                WHERE product_id = :product_id';

        $this->pdo->query($sql, [
            ':product_id' => $id,
            ':name' => $data['name'],
            ':barcode' => $data['barcode'],
            ':brand' => $data['brand'],
            ':model' => $data['model'],
            ':type' => $data['type'],
            ':status' => $data['status'],
            ':stock_quantity' => $data['stock_quantity'],
            ':unit_price' => $data['unit_price'],
            ':cost_price' => $data['cost_price'],
            ':category_id' => $data['category_id'], // Include category_id
        ]);
    }

    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM products WHERE product_id = :product_id";
        $this->pdo->query($sql, ['product_id' => $productId]);
    }

    public function show($id)
    {

        $sql = "SELECT products.product_id, products.name, products.barcode, products.brand, products.description, 
                products.model, products.type, categories.name AS category_name
                FROM products  
                LEFT JOIN categories ON products.category_id = categories.category_id
                WHERE products.product_id = :product_id";

        $stmt = $this->pdo->query($sql, [':product_id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
