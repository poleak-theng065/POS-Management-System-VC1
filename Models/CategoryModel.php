<?php
require_once "Database/Database.php";

class CategoryModel
{
    private $pdo;

    public function __construct()
    {

        $host = "localhost";         
        $dbname = "vc_db";      
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
        $stmt = $this->pdo->query('INSERT INTO categories (name, model, type, description) VALUES (:name, :model, :type, :description)', [
            'name' => $data['name'],
            'model' => $data['model'],
            'type' => $data['type'],
            'description' => $data['description'],  
        ]);
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
        $stmt = $this->pdo->query('UPDATE categories SET name = :name, model = :model, type = :type, description = :description WHERE id = :id', [
            'name' => $data['name'],
            'model' => $data['model'],
            'type' => $data['type'],
            'description' => $data['description'],
            'id' => $id
        ]);
    }


    // function deleteCategory($id)
    // {
    //     $this->pdo->query('DELETE FROM categories WHERE id = :id', ['id' => $id]);
    // }
    
}
