<?php
require_once "Database/Database.php";

class CategoryModel
{
    private $pdo;

    public function __construct()
    {
        // Database connection details
        $host = "localhost";         // Change if necessary
        $dbname = "vc_db";      // Replace with your actual database name
        $username = "root";          // Default for XAMPP/MAMP
        $password = "";              // Default is empty for XAMPP/MAMP

        // Initialize Database connection
        $this->pdo = new Database($host, $dbname, $username, $password);
    }

    public function getCategories()
    {
        $categories = $this->pdo->query("SELECT * FROM categories");
        $result = $categories->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result); // Debugging: Check if query returns data
        return $result;
    }

    

}
