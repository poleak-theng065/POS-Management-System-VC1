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
        // Assuming the database column is 'Category_ID' based on the modal
        $sql = "DELETE FROM categories WHERE Category_ID = :id";
        $params = ['id' => $id]; // Prepare the parameters for the query

        $stmt = $this->db->query($sql, $params); // Execute the query with parameters

        return $stmt !== false; // Return true if the query was successful, false otherwise
    }
}