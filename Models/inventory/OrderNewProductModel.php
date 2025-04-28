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
    $category, $model, $supplier, $productStatus, $basePriceUSD, $basePriceKHR, $quantity, $exchangeRate, $totalPriceUSD , $totalPriceKHR, $image)
    {
        try {
            $this->db->query(
                "INSERT INTO order_products (product_name, barcode, brand, expected_delivery, order_date, status, 
                category, model, supplier, product_status, base_price_usd, base_price_kh, quantity, exchange_rate, total_price_usd, total_price_kh, image_path)
                VALUES (:product_name, :barcode, :brand, :expected_delivery, :order_date, :status,
                :category, :model, :supplier, :product_status, :base_price_usd, :base_price_kh,
                :quantity, :exchange_rate, :total_price_usd, :total_price_kh, :image_path)",
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
                    ':total_price_kh' => $totalPriceKHR,
                    ':image_path' => $image,
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
        $exchangeRate, $totalPriceUSD, $totalPriceKHR, $image = null) 
        {
            try {
                // Start SQL query
                $sql = "UPDATE order_products 
                        SET product_name = :product_name, barcode = :barcode, brand = :brand, 
                            expected_delivery = :expected_delivery, order_date = :order_date, 
                            status = :status, category = :category, model = :model, 
                            supplier = :supplier, product_status = :product_status, 
                            base_price_usd = :base_price_usd, base_price_kh = :base_price_kh, 
                            quantity = :quantity, exchange_rate = :exchange_rate, 
                            total_price_usd = :total_price_usd, total_price_kh = :total_price_kh";

                // If a new image is uploaded, update the image field
                if ($image !== null) {
                    $sql .= ", image_path = :image_path";
                }

                $sql .= " WHERE id = :id";

                // Parameters to bind
                $params = [
                    ':id' => $id,
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
                ];

                // If new image is uploaded, add it to params
                if ($image !== null) {
                    $params[':image_path'] = $image;
                }

                // Execute the query
                $this->db->query($sql, $params);
            } catch (PDOException $e) {
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