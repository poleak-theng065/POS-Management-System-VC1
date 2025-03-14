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
        $categories = $this->pdo->query("SELECT * FROM categories");
        $result = $categories->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function createCategory($data)
    {
        $sql = 'INSERT INTO categories (Category_Name, Model_Product, Type_Product) 
                VALUES (:Category_Name, :Model_Product, :Type_Product)';

        $stmt = $this->pdo->query($sql, [
            'Category_Name' => $data['Category_Name'],
            'Model_Product' => $data['Model_Product'],
            'Type_Product' => $data['Type_Product'],
        ]);

        if ($stmt->errorCode() != '00000') {
            print_r($stmt->errorInfo());
        }
    }


    function getCategory($id)
    {
        $stmt = $this->pdo->query(
            'SELECT * FROM categories WHERE Category_ID = :Category_ID',
            ['Category_ID' => $id]
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
                SET Category_Name = :Category_Name, 
                    Model_Product = :Model_Product, 
                    Type_Product = :Type_Product 
                WHERE Category_ID = :Category_ID';

        $stmt = $this->pdo->query($sql, [
            ':Category_ID' => $id,
            ':Category_Name' => $data['Category_Name'],
            ':Model_Product' => $data['Model_Product'],
            ':Type_Product' => $data['Type_Product'],
        ]);

        if ($stmt->rowCount() === 0) {
            echo 'Warning: No changes were made. The category may already have the same values.';
        }
    }

    public function deleteCategory($categoryId)
    {
        $sql = "DELETE FROM products WHERE Product_Category = :categoryId";
        $this->pdo->query($sql, ['categoryId' => $categoryId]);

        $sql = "DELETE FROM categories WHERE Category_ID = :categoryId";
        $this->pdo->query($sql, ['categoryId' => $categoryId]);
    }

}
