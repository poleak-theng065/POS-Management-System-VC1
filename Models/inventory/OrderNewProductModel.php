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
                "INSERT INTO order_products (product_name, barcode, brand, expected_delivery, order_date, status, 
                category, model, supplier, product_status, base_price_usd, base_price_kh, quantity, exchange_rate, total_price_usd, total_price_kh)
                VALUES (:product_name, :barcode, :brand, :expected_delivery, :order_date, :status,
                :category, :model, :supplier, :product_status, :base_price_usd, :base_price_kh,
                :quantity, :exchange_rate, :total_price_usd, :total_price_kh)",
                [
                    ':product_name' => $productName,
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
                ]
            );
        } catch (PDOException $e) {
            // Log or display the error message more clearly
            echo "Error adding product: " . $e->getMessage();
            // Optionally log to a file or redirect to an error page
        }
    }


    public function getOrderNewProductById($id) {

        $result = $this->db->query("SELECT * FROM order_products WHERE id = :id", [':id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    

    public function updateNewOrder(
        $id, 
        $productName, 
        $barCode, 
        $brand, 
        $orderDate, 
        $expectedDelivery, 
        $productStatus, 
        $category, 
        $model, 
        $supplier, 
        $status, 
        $basePriceUSD, 
        $basePriceKHR, 
        $quantity, 
        $exchangeRate, 
        $totalPriceUSD, 
        $totalPriceKHR
    ) {
        try {
            // Prepare SQL query for update
            $query = "UPDATE new_orders 
                      SET 
                        product_name = :product_name, 
                        barcode = :barcode,
                        brand = :brand,
                        order_date = :order_date, 
                        expected_delivery = :expected_delivery, 
                        product_status = :product_status,
                        category = :category,
                        model = :model,
                        supplier = :supplier, 
                        status = :status,
                        base_price_usd = :base_price_usd,
                        base_price_khr = :base_price_khr,
                        quantity = :quantity,
                        exchange_rate = :exchange_rate,
                        total_price_usd = :total_price_usd,
                        total_price_khr = :total_price_khr
                      WHERE id = :id";
            
            // Prepare the statement
            $stmt = $this->db->prepare($query);
    
            // Bind values to placeholders
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':product_name', $productName, PDO::PARAM_STR);
            $stmt->bindParam(':barcode', $barCode, PDO::PARAM_STR);
            $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
            $stmt->bindParam(':order_date', $orderDate, PDO::PARAM_STR);
            $stmt->bindParam(':expected_delivery', $expectedDelivery, PDO::PARAM_STR);
            $stmt->bindParam(':product_status', $productStatus, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
            $stmt->bindParam(':model', $model, PDO::PARAM_STR);
            $stmt->bindParam(':supplier', $supplier, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':base_price_usd', $basePriceUSD, PDO::PARAM_STR);
            $stmt->bindParam(':base_price_khr', $basePriceKHR, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':exchange_rate', $exchangeRate, PDO::PARAM_STR);
            $stmt->bindParam(':total_price_usd', $totalPriceUSD, PDO::PARAM_STR);
            $stmt->bindParam(':total_price_khr', $totalPriceKHR, PDO::PARAM_STR);
    
            // Execute the statement
            $stmt->execute();
    
        } catch (PDOException $e) {
            // Handle any error that occurs
            echo "Error updating order: " . $e->getMessage();
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