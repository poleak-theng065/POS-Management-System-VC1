<?php

class SaleReceiptModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "pos-system", "root", "PassWord@123!");
    }

    public function fetchSales() {
        // Explicitly select only needed fields with proper table prefixes
        $query = "SELECT 
                    sales.sale_id,
                    sales.customer_name,
                    sales.sale_date,
                    sales.sale_time,
                    sales.total_amount,
                    sales.phone_number,
                    sales.total_discount,
                    sale_items.sale_item_id,
                    sale_items.product_id,
                    sale_items.quantity,
                    sale_items.unit_price,
                    sale_items.discount,
                    sale_items.total_price,
                    products.name as product_name,
                    products.description,
                    products.barcode
                  FROM sales 
                  JOIN sale_items ON sales.sale_id = sale_items.sale_id
                  JOIN products ON sale_items.product_id = products.product_id
                  ORDER BY sales.sale_date DESC, sales.sale_time DESC";
                  
        $result = $this->db->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        
        // Group items by sale with proper data typing
        $groupedSales = [];
        foreach ($rows as $row) {
            $saleId = $row['sale_id'];
            
            if (!isset($groupedSales[$saleId])) {
                $groupedSales[$saleId] = [
                    'sale_id' => (int)$row['sale_id'],
                    'customer_name' => $row['customer_name'] ?? 'Walk-in Customer',
                    'sale_date' => $row['sale_date'],
                    'sale_time' => $row['sale_time'],
                    'total_amount' => (float)$row['total_amount'],
                    'total_discount' => (float)$row['total_discount'],
                    'phone_number' => $row['phone_number'] ?? null,
                    'products' => []
                ];
            }
            
            // Convert all numeric values explicitly
            $groupedSales[$saleId]['products'][] = [
                'product_id' => (int)$row['product_id'],
                'name' => $row['product_name'],
                'quantity' => (int)$row['quantity'],
                'unit_price' => (float)$row['unit_price'], // Now properly as decimal
                'total_price' => (float)$row['total_price'],
                'discount' => (float)$row['discount'],
                'barcode' => $row['barcode'] ?? null
            ];
        }
        
        return $groupedSales;
    }
}