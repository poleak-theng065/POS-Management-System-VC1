<?php

class ImportNewProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "inventorydb", "root", "");
    }

    public function getNewImportProduct() {
        $result = $this->db->query("SELECT * FROM import_products");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}