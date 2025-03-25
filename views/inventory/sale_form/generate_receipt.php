<div class="container mt-4">
    <h1>Receipt</h1>
    <div class="card p-4 bg-light shadow-sm border-0">
        <?php if (!empty($saleItems)): ?>
            <!-- Display receipt table -->
            <div class="receipt-header text-center mb-4">
                <h3>Store Name</h3>
                <p>123 Store Address, City, Country</p>
                <p>Phone: (123) 456-7890</p>
                <p>Email: store@example.com</p>
                <hr>
            </div>

            <div class="receipt-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Unit Price ($)</th>
                            <th>Quantity</th>
                            <th>Discount ($)</th>
                            <th>Subtotal ($)</th>
                            <th>Sale Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $grandTotal = 0; 
                        foreach ($saleItems as $saleItem): 
                            $subtotal = $saleItem['total_price'] ?? 0;
                            $grandTotal += $subtotal;
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($saleItem['barcode'] ?? 'N/A') ?></td>
                                <td><?= number_format($saleItem['unit_price'] ?? 0, 2) ?></td>
                                <td><?= htmlspecialchars($saleItem['quantity'] ?? 0) ?></td>
                                <td><?= number_format($saleItem['discount'] ?? 0, 2) ?></td>
                                <td><?= number_format($subtotal, 2) ?></td>
                                <td><?= htmlspecialchars($saleItem['sale_date'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Grand Total:</th>
                            <th>$<?= number_format($grandTotal, 2) ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="receipt-footer text-center mt-4">
                <p><strong>Status:</strong> Completed</p>
                <p>Thank you for your purchase!</p>
                <p>Visit us again!</p>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-primary no-print" onclick="window.print()">Print Receipt</button>
                <a href="/generate_receipt/create" class="btn btn-secondary no-print">Add Another Sale</a>
            </div>
        <?php else: ?>
            <p>No sale items found.</p>
            <div class="text-center">
                <a href="/generate_receipt/create" class="btn btn-primary">Create a Sale</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    @media print {
        .no-print {
            display: none;
        }
        .receipt-header, .receipt-footer {
            font-size: 14px;
        }
        .table {
            font-size: 12px;
        }
        .container {
            width: 100%;
            margin: 0;
            padding: 0;
        }
    }
</style>