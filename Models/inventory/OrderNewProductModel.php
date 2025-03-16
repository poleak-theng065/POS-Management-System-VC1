<?php

class OrderNewProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "inventorydb", "root", "");
    }

    public function getOrderNewProduct() {

        $result = $this->db->query("SELECT * FROM new_orders");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNewOrder($productName, $quantity, $orderDate, $expectedDelivery, $supplier)
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

    public function getOrderNewProductById($id) {

        $result = $this->db->query("SELECT * FROM new_orders WHERE id = :id", [':id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNewOrder($id, $productName, $quantity, $orderDate, $expectedDelivery, $supplier)
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
                    ':id' => $id,
                    ':product_name' => $productName,
                    ':quantity' => $quantity,
                    ':order_date' => $orderDate,
                    ':expected_delivery' => $expectedDelivery,
                    ':supplier' => $supplier,
                ]
            );
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }



    public function deleteOrderNew($id)
    {
        try {
            $this->db->query("DELETE FROM new_orders WHERE id = :id", [':id' => $id]);
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }
    

}