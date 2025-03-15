<?php

class ReturnProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "test_vc1", "root", "");
    }

    public function getReturnProduct() {

        $result = $this->db->query("SELECT * FROM return_product");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNewReturnProduct($productName, $quantity, $orderDate, $expectedDelivery, $supplier)
    {
        try {
            $this->db->query(
                "INSERT INTO new_orders (product_name, quantity, order_date, expected_delivery, supplier) 
                VALUES (:product_name, :quantity, :order_date, :expected_delivery, :supplier)",
                [
                    ':product_name' => $productName,
                    ':quantity' => $quantity,
                    ':order_date' => $orderDate,
                    ':expected_delivery' => $expectedDelivery,
                    ':supplier' => $supplier
                ]
            );
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }

    public function getReturnProductById($id) {

        $result = $this->db->query("SELECT * FROM new_orders WHERE id = :id", [':id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateReturnProduct($productName, $quantity, $orderDate, $expectedDelivery, $supplier, $id)
    {
        try {
            $this->db->query(
                "UPDATE new_orders  SET 
                product_name = :product_name, 
                quantity = :quantity, 
                order_date = :order_date, 
                expected_delivery = :expected_delivery, 
                supplier = :supplier 
                WHERE id = :id",

                [
                    ':product_name' => $productName,
                    ':quantity' => $quantity,
                    ':order_date' => $orderDate,
                    ':expected_delivery' => $expectedDelivery,
                    ':supplier' => $supplier,
                    ':id' => $id
                ]
            );
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }



    public function deleteReturnProduct($id)
    {
        try {
            $this->db->query("DELETE FROM new_orders WHERE id = :id", [':id' => $id]);
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }
    

}