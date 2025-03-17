<?php
require_once "Database/Database.php";

class CategoryModel
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
        $categories = $this->pdo->query("
            SELECT categories.*, 
                   IFNULL(products.brand, 'No Brand') AS brand,
                   IFNULL(products.model, 'No Model') AS model,
                   IFNULL(products.type, 'No Type') AS type,
                   IFNULL(products.stock_quantity, 0) AS stock_quantity
            FROM categories
            LEFT JOIN products ON categories.category_id = products.category_id
            ORDER BY categories.category_id DESC
        ");

        $result = $categories->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProducts()
    {
        $categories = $this->pdo->query("SELECT * FROM products");
        $result = $categories->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function createCategory($data)
    {
        $sql = 'INSERT INTO categories (name, description) 
                VALUES (:name, :description)';

        $stmt = $this->pdo->query($sql, [
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        if ($stmt->errorCode() != '00000') {
            print_r($stmt->errorInfo());
        }
    }

    function getCategory($id)
    {
        $stmt = $this->pdo->query(
            'SELECT * FROM categories WHERE category_id = :category_id',
            ['category_id' => $id]
        );
        $category = $stmt->fetch();
        return $category;
    }

    function updateCategory($id, $data)
    {
        if (!$id) {
            die('Error: No category ID provided.');
        }

        $sql = 'UPDATE categories 
            SET name = :name, 
                description = :description 
            WHERE category_id = :category_id';

        $stmt = $this->pdo->query($sql, [
            ':category_id' => $id,
            ':name' => $data['name'],
            ':description' => $data['description'],
        ]);

        if ($stmt->rowCount() === 0) {
            echo 'Warning: No changes were made. The category may already have the same values.';
        }
    }

    public function deleteCategory($categoryId)
    {
        $sql = "DELETE FROM categories WHERE category_id = :category_id";
        $this->pdo->query($sql, ['category_id' => $categoryId]);

        $sql = "DELETE FROM categories WHERE category_id = :category_id";
        $this->pdo->query($sql, ['category_id' => $categoryId]);
    }
}
