<?php

class ArrivedProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "inventorydb", "root", "");
    }

    public function getArrivedProduct() {

        $result = $this->db->query("SELECT * FROM new_orders");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getArrivedProductById($id) {

        $result = $this->db->query("SELECT * FROM new_orders WHERE id = :id", [':id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }


    public function updateArrivedProduct($id, $productName, $quantity, $order_date, $expected_delivery, $supplier, $status)
    {
        try {
            $this->db->query(
                "UPDATE new_orders  SET 
                product_name = :product_name, 
                quantity = :quantity, 
                order_date = :order_date, 
                expected_delivery = :expected_delivery, 
                supplier = :supplier,
                status = :status 
                WHERE id = :id",

                [
                    ':id' => $id,
                    ':product_name' => $productName,
                    ':quantity' => $quantity,
                    ':order_date' => $orderDate,
                    ':expected_delivery' => $expectedDelivery,
                    ':supplier' => $supplier,
                    ':status' => $status
                ]
            );
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }



    public function deleteArrivedProduct($id)
    {
        try {
            $this->db->query("DELETE FROM new_orders WHERE id = :id", [':id' => $id]);
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }
    

}