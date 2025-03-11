<?php
require_once './Database/Database.php';

class CategoryModel
{
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        $this->db = new Database("localhost", "inventorydb", "root", ""); // Database connection
    }

    // Fetch all categories
    public function getCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    // Delete a category by ID
    public function deleteCategory($id)
    {
        $this->db->query("DELETE FROM categories WHERE id = :id", ['id' => $id]);
    }
}
