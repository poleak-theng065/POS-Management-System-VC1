<?php
require_once 'Database/database.php';

class CategoryModel
{
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        // Initialize the database connection here
        $this->db = new Database("localhost", "inventorydb", "root", ""); // Database connection class
    }

    // Fetch all categories
    public function getCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch all categories as an associative array
    }

    // Insert a new category into the database
    public function insertCategory($data)
    {
        $this->db->query(
            "INSERT INTO categories (Category_Name, Quantity_Product, Model_Product, Type_Product, Sell_Price) 
            VALUES (:Category_Name, :Quantity_Product, :Model_Product, :Type_Product, :Sell_Price)",
            [
                'Category_Name' => $data['Category_Name'],
                'Quantity_Product' => $data['Quantity_Product'],
                'Model_Product' => $data['Model_Product'],
                'Type_Product' => $data['Type_Product'],
                'Sell_Price' => $data['Sell_Price'],
            ]
        );
    }

    // Get a single category by ID
    public function getCategory($id)
    {
        $stmt = $this->db->query("SELECT * FROM categories WHERE id = :id", ['id' => $id]);
        return $stmt->fetch();
    }

    // Update a category by ID
    public function updateCategory($id, $data)
    {
        $this->db->query(
            "UPDATE categories SET 
            Category_Name = :Category_Name, 
            Quantity_Product = :Quantity_Product, 
            Model_Product = :Model_Product, 
            Type_Product = :Type_Product, 
            Sell_Price = :Sell_Price 
            WHERE id = :id",
            [
                'Category_Name' => $data['Category_Name'],
                'Quantity_Product' => $data['Quantity_Product'],
                'Model_Product' => $data['Model_Product'],
                'Type_Product' => $data['Type_Product'],
                'Sell_Price' => $data['Sell_Price'],
                'id' => $id
            ]
        );
    }
    public function deleteCategory($id)
    {
        try {
            // Ensure the correct column name (Category_ID or id) is used in the query
            $this->db->query("DELETE FROM categories WHERE Category_ID = :id", ['id' => $id]);
        } catch (Exception $e) {
            // Log the error to a file or a logging system
            error_log("Error deleting category: " . $e->getMessage());
            
            // Show a generic error message to the user
            echo "An error occurred while deleting the category. Please try again later.";
        }
    }
    
}
