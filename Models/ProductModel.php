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

    public function getProducts()
    {
        $products = $this->pdo->query("SELECT * FROM products");
        $result = $products->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    function createProduct($data)
    {
        $sql = 'INSERT INTO products (name, barcode, brand, model, type, status, stock_quantity, unit_price, cost_price) 
                VALUES (:name, :barcode, :brand, :model, :type, :status, :stock_quantity, :unit_price, :cost_price)';

        $this->pdo->query($sql, [
            ':name' => $data['name'],
            ':barcode' => $data['barcode'],
            ':brand' => $data['brand'],
            ':model' => $data['model'],
            ':type' => $data['type'],
            ':status' => $data['status'],
            ':stock_quantity' => $data['stock_quantity'],
            ':unit_price' => $data['unit_price'],
            ':cost_price' => $data['cost_price'],
        ]);
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
                    cost_price = :cost_price
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
        ]);
    }
    

    
    

    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM products WHERE product_id = :product_id";
        $this->pdo->query($sql, ['product_id' => $productId]);

        $sql = "DELETE FROM products WHERE product_id = :product_id";
        $this->pdo->query($sql, ['product_id' => $productId]);
    }
}
