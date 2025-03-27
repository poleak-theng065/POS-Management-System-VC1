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
                <?php if (!empty($saleItems)): ?>
                    <div class="list-group">
                        <?php foreach ($saleItems as $item): ?>
                            <div class="list-group-item mb-3 p-3 border rounded">
                                <p><strong>Barcode:</strong> <?= htmlspecialchars($item['barcode']) ?></p>
                                <p><strong>Quantity:</strong> <?= htmlspecialchars($item['quantity']) ?></p>
                                <p><strong>Discount ($):</strong> <?= htmlspecialchars($item['discount']) ?></p>
                                <p><strong>Total Price ($):</strong> <?= htmlspecialchars($item['total_price']) ?></p>
                                <p><strong>Sale Date:</strong> <?= htmlspecialchars($item['sale_date']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted">No sales found.</p>
                <?php endif; ?>
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

        .receipt-header,
        .receipt-footer {
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