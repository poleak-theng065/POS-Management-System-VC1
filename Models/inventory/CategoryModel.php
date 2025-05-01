<?php
require_once "Database/Database.php";

class CategoryModel
{
    private $pdo;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "pos-system";
        $username = "root";
        $password = "PassWord@123!";

        $this->pdo = new Database($host, $dbname, $username, $password);
    }

    public function getCategories()
    {
        $categories = $this->pdo->query("
            SELECT 
                categories.*, 
                COUNT(DISTINCT products.brand) AS total_brands, 
                SUM(products.stock_quantity) AS total_stock_quantity
            FROM categories
            LEFT JOIN products ON categories.category_id = products.category_id
            GROUP BY categories.category_id
            ORDER BY categories.category_id DESC
        ");

        return $categories->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProducts()
    {
        $categories = $this->pdo->query("SELECT * FROM products");
        $result = $categories->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function createCategory($data)
    {
        // Check for duplicate name
        $checkSql = 'SELECT COUNT(*) FROM categories WHERE name = :name';
        $checkStmt = $this->pdo->query($checkSql, [
            'name' => $data['name']
        ]);

        if ($checkStmt->fetchColumn() > 0) {
            echo 'Error: A category with the same name already exists.';
            return "Error: Duplicate entry.";
        }

        // Insert new category
        $sql = 'INSERT INTO categories (name, description) 
                VALUES (:name, :description)';

        $stmt = $this->pdo->query($sql, [
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        if ($stmt->errorCode() != '00000') {
            print_r($stmt->errorInfo());
            return false;
        }

        return true;
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
            return false; // No category ID provided
        }

        // Check for duplicate name
        $checkSql = 'SELECT COUNT(*) FROM categories WHERE name = :name AND category_id != :category_id';
        $checkStmt = $this->pdo->query($checkSql, [
            ':name' => $data['name'],
            ':category_id' => $id
        ]);

        if ($checkStmt->fetchColumn() > 0) {
            echo 'Error: A category with the same name already exists.';
            return "Error: Duplicate entry.";
        }

        // Update category
        $sql = 'UPDATE categories 
            SET name = :name, 
                description = :description 
            WHERE category_id = :category_id';

        $stmt = $this->pdo->query($sql, [
            ':category_id' => $id,
            ':name' => $data['name'],
            ':description' => $data['description'],
        ]);

        if ($stmt->rowCount() > 0) {
            return true; // Update successful
        } else {
            return false; // No changes were made
        }
    }

    public function deleteCategory($categoryId)
    {   
        $sql = "DELETE FROM categories WHERE category_id = :category_id";
        $stmt = $this->pdo->query($sql, ['category_id' => $categoryId]);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

        // $sql = "DELETE FROM categories WHERE category_id = :category_id";
        // $this->pdo->query($sql, ['category_id' => $categoryId]);
    }
}
