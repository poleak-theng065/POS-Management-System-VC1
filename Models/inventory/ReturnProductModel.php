<?php

class ReturnProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "pos-system", "root", "");
    }

    public function getReturnProduct() {

        $result = $this->db->query("SELECT * FROM return_products");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNewReturnProduct($productName, $quantity, $reason_return, $type_return, $return_date)
    {
        try {
            $this->db->query(
                "INSERT INTO return_products (product_name, quantity, reason_for_return, type_of_return, return_date) 
                VALUES (:product_name, :quantity, :reason_for_return, :type_of_return, :return_date)",
                [
                    ':product_name' => $productName,
                    ':quantity' => $quantity,
                    ':reason_for_return' => $reason_return,
                    ':type_of_return' => $type_return,
                    ':return_date' => $return_date
                ]
            );
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }

    public function getReturnProductById($id) {

        $result = $this->db->query("SELECT * FROM return_products WHERE return_id = :return_id", [':return_id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateReturnProduct($id, $productName, $quantity, $reason_return, $type_return, $return_date)
    {
        try {
            $this->db->query(
                "UPDATE return_products  SET 
                product_name = :product_name, 
                quantity = :quantity, 
                reason_for_return = :reason_for_return, 
                type_of_return = :type_of_return, 
                return_date = :return_date 
                WHERE return_id = :return_id",

                [
                    ':return_id' => $id,
                    ':product_name' => $productName,
                    ':quantity' => $quantity,
                    ':reason_for_return' => $reason_return,
                    ':type_of_return' => $type_return,
                    ':return_date' => $return_date,
                ]
            );
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }


    public function deleteReturnProduct($id)
    {
        try {
            $this->db->query("DELETE FROM return_products WHERE return_id = :return_id", [':return_id' => $id]);
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }
    

}