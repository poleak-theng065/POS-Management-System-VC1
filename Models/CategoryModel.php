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
        $sql = 'INSERT INTO categories (name, model, type, description) 
                VALUES (:name, :model, :type, :description)';

        $stmt = $this->pdo->query($sql, [
            'Category_Name' => $data['Category_Name'],
            'Quantity_Product' => $data['Quantity_Product'],
            'Model_Product' => $data['Model_Product'],
            'Type_Product' => $data['Type_Product'],
            'Sell_Price' => $data['Sell_Price'],
        ]);

        if ($stmt->errorCode() != '00000') {
            print_r($stmt->errorInfo());
        }
    }

    function getCategory($id)
    {
        $stmt = $this->pdo->query(
            'SELECT * FROM categories WHERE id = :id',
            ['id' => $id]
        );
        $category = $stmt->fetch();
        return $category;
    }


    function updateCategory($id, $data)
    {
        $sql = 'UPDATE categories 
                SET name = :name, model = :model, type = :type, description = :description 
                WHERE id = :id';

        $stmt = $this->pdo->query($sql, [
            'id' => $id,
            'Category_Name' => $data['Category_Name'],
            'Quantity_Product' => $data['Quantity_Productl'],
            'Model_Product' => $data['Model_Product'],
            'Type_Product' => $data['Type_Product'],
            'Sell_Price' => $data['Sell_Price'],
        ]);

        if ($stmt->rowCount() === 0) {
            die('Error: No category was updated.');
        }
    }

    // Delete a category by ID
    public function deleteCategory($categoryId)
    {
        $sql = "DELETE FROM products WHERE Product_Category = :categoryId";
        $this->pdo->query($sql, ['categoryId' => $categoryId]);

        $sql = "DELETE FROM categories WHERE Category_ID = :categoryId";
        $this->pdo->query($sql, ['categoryId' => $categoryId]);
    }

}

