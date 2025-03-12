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

    public function get_categories()
    {
        $categories = $this->pdo->query("SELECT * FROM categories");
        $result = $categories->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function create_category($data)
    {
        $sql = 'INSERT INTO categories (name, model, type, description) 
                VALUES (:name, :model, :type, :description)';

        $stmt = $this->pdo->query($sql, [
            'name' => $data['name'],
            'model' => $data['model'],
            'type' => $data['type'],
            'description' => $data['description'],
        ]);

        if ($stmt->errorCode() != '00000') {
            print_r($stmt->errorInfo());
        }
    }

    function get_category($id)
    {
        $stmt = $this->pdo->query(
            'SELECT * FROM categories WHERE id = :id',
            ['id' => $id]
        );
        $category = $stmt->fetch();
        return $category;
    }


    function update_category($id, $data)
    {
        $sql = 'UPDATE categories 
                SET name = :name, model = :model, type = :type, description = :description 
                WHERE id = :id';

        $stmt = $this->pdo->query($sql, [
            'id' => $id,
            'name' => $data['name'],
            'model' => $data['model'],
            'type' => $data['type'],
            'description' => $data['description']
        ]);

        if ($stmt->rowCount() === 0) {
            die('Error: No category was updated.');
        }
    }
}
