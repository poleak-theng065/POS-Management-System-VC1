<?php

class SaleReceiptModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "pos-system", "root", "");
    }

    public function fetchSales() {
        $query = "SELECT * FROM sales";
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
   
    

}