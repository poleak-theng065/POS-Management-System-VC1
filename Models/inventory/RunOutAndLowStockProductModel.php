<?php 

class RunOutAndLowStockProductModel {

    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "pos-system", "root", "");
    }

    public function getRunOutAndLowStockProduct() {
        $result = $this->db->query("SELECT * FROM products WHERE stock_quantity <= 5");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}