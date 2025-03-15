<?php

class ImportNewProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "test_vc1", "root", "");
    }

    public function getNewImportProduct() {
        $result = $this->db->query("SELECT * FROM import_products");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}