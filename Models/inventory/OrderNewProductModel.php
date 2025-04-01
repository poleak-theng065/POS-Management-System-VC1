<?php

class OrderNewProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "pos-system", "root", "");
    }

    public function getOrderNewProduct() {

        $result = $this->db->query("SELECT * FROM order_products");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNewOrder($productName, $barCode, $brand, $expectedDelivery, $orderDate, $status, 
    $category, $model, $supplier, $productStatus, $basePriceUSD, $basePriceKHR, $quantity, $exchangeRate, $totalPriceUSD , $totalPriceKHR)
    {
        try {
            $this->db->query(
                "INSERT INTO order_products (name, barcode, brand, expected_delivery, order_date, status, 
                category, model, supplier, product_status, base_price_usd, base_price_kh, quantity, exchange_rate, total_price_usd, total_price_kh)
                VALUES (:name, :barcode, :brand, :expected_delivery, :order_date, :status,
                :category, :model, :supplier, :product_status, :base_price_usd, :base_price_kh,
                :quantity, :exchange_rate, :total_price_usd, :total_price_kh)",
                [
                    ':name' => $productName,
                    ':barcode' => $barCode,
                    ':brand' => $brand,
                    ':expected_delivery' => $expectedDelivery,
                    ':order_date' => $orderDate,
                    ':status' => $status,
                    ':category' => $category,
                    ':model' => $model,
                    ':supplier' => $supplier,
                    ':product_status' => $productStatus,
                    ':base_price_usd' => $basePriceUSD,
                    ':base_price_kh' => $basePriceKHR,
                    ':quantity' => $quantity,
                    ':exchange_rate' => $exchangeRate,
                    ':total_price_usd' => $totalPriceUSD,
                    ':total_price_kh' => $totalPriceKHR
                ]);
        } catch (PDOException $e) {
            // Handle error (log it, show a friendly message, etc.)
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function getOrderNewProductById($id) {

        $result = $this->db->query("SELECT * FROM order_products WHERE id = :id", [':id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    

    public function updateNewOrder($id, $productName, $barCode, $brand, $expectedDelivery, $orderDate,
    $status, $category, $model, $supplier, $productStatus, $basePriceUSD, $basePriceKHR, $quantity, 
    $exchangeRate, $totalPriceUSD, $totalPriceKHR) 
    {
        try {
            // SQL query to update an order
            $sql = "UPDATE order_products 
                    SET name = :name, barcode = :barcode, brand = :brand, expected_delivery = :expected_delivery,
                        order_date = :order_date, status = :status, 
                        category = :category, model = :model, supplier = :supplier, product_status = :product_status, 
                        base_price_usd = :base_price_usd, base_price_kh = :base_price_kh, 
                        quantity = :quantity, exchange_rate = :exchange_rate, 
                        total_price_usd = :total_price_usd, total_price_kh = :total_price_kh 
                    WHERE id = :id";
            
            // Parameters to bind to the SQL query
            $params = [
                ':id' => $id,
                ':name' => $productName,
                ':barcode' => $barCode,
                ':brand' => $brand,
                ':expected_delivery' => $expectedDelivery,
                ':order_date' => $orderDate,
                ':status' => $status,
                ':category' => $category,
                ':model' => $model,
                ':supplier' => $supplier,
                ':product_status' => $productStatus,
                ':base_price_usd' => $basePriceUSD,
                ':base_price_kh' => $basePriceKHR,
                ':quantity' => $quantity,
                ':exchange_rate' => $exchangeRate,
                ':total_price_usd' => $totalPriceUSD,
                ':total_price_kh' => $totalPriceKHR,
            ];

            // Execute the query using the Database class's query method
            $this->db->query($sql, $params);
        } catch (PDOException $e) {
            // Log or display the error message more clearly
            echo "Error updating order: " . $e->getMessage();
            // Optionally log to a file or redirect to an error page
        }
    }

    
    
    public function deleteOrderNew($id)
    {
        try {
            $this->db->query("DELETE FROM order_products WHERE id = :id", [':id' => $id]);
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }
    

}