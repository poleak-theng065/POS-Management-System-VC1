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


    // function createProduct($data)
    // {
    //     $sql = 'INSERT INTO products (name, model, type, description) 
    //             VALUES (:name, :model, :type, :description)';

    //     $stmt = $this->pdo->query($sql, [
    //         'name' => $data['name'],
    //         'model' => $data['model'],
    //         'type' => $data['type'],
    //         'description' => $data['description'],
    //     ]);

    //     if ($stmt->errorCode() != '00000') {
    //         print_r($stmt->errorInfo());
    //     }
    // }
}
