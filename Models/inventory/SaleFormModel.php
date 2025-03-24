<?php
require_once "Database/Database.php";

class SaleFormModel
{
    private $db;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "inventorydb";
        $username = "root";
        $password = "";

        $this->db = new Database($host, $dbname, $username, $password);
    }
    

    public function getProducts()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM products");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return [];
        }
    }

    public function getSaleItems()
    {
        try {
            $stmt = $this->db->query("
                SELECT sale_items.*, 
                       products.name AS product_name, 
                       products.barcode
                FROM sale_items
                LEFT JOIN products ON sale_items.product_id = products.product_id
                ORDER BY sale_items.sale_item_id DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching sale items: " . $e->getMessage());
            return [];
        }
    }
    

    public function createSaleForm($data)
    {
        try {
            $sql = 'INSERT INTO sale_items (product_id, quantity, unit_price, total_price) 
                    VALUES (:product_id, :quantity, :unit_price, :total_price)';
    
            $stmt = $this->db->query($sql, [
                ':product_id' => $data['product_id'],
                ':quantity' => $data['quantity'],
                ':unit_price' => $data['unit_price'],
                ':total_price' => $data['total_price'],
            ]);
    
            return $stmt ? true : false;
        } catch (Exception $e) {
            error_log("Error creating sale form: " . $e->getMessage());
            return false;
        }
    }    

    function getSaleItem($id)
    {
        $stmt = $this->db->query(
            'SELECT * FROM sale_items WHERE sale_item_id = :sale_item_id',
            ['sale_item_id' => $id]
        );
        $saleItem = $stmt->fetch();
        return $saleItem;
    }

}
