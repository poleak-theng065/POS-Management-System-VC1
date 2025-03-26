<?php
require_once "Database/Database.php";
class OutStockModel
{
    private $pdo;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "pos-system";
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

    public function getProducts()
    {
        $products = $this->pdo->query("
            SELECT products.*, 
                   IFNULL(categories.name, '') AS category_name
            FROM products
            LEFT JOIN categories ON products.category_id = categories.category_id
            WHERE products.stock_quantity = 0
            ORDER BY products.product_id DESC
        ");

        return $products->fetchAll(PDO::FETCH_ASSOC);
    }
}
