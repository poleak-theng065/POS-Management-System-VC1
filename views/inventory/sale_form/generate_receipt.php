<div class="container mt-4">
    <h1>Receipt</h1>
    <div class="card">
        <?php if (!empty($saleItems)): ?>
            <?php foreach ($saleItems as $saleItem): ?>
                <p><strong>Product Barcode:</strong> <?= htmlspecialchars($product['barcode'] ?? 'N/A') ?></p>
                <p><strong>Product Name:</strong> <?= htmlspecialchars($product['name'] ?? 'N/A') ?></p>
                <p><strong>Price:</strong> $<?= number_format($saleItem['unit_price'] ?? 0, 2) ?></p>
                <p><strong>Discount:</strong> <?= htmlspecialchars($saleItem['discount'] ?? 0) ?>%</p>
                <p><strong>Total Amount:</strong> $<?= number_format($saleItem['total_price'] ?? 0, 2) ?></p>
                <p><strong>Sale Date:</strong> <?= htmlspecialchars($saleItem['sale_date'] ?? 'N/A') ?></p>
                <p><strong>Status:</strong> Completed</p>
                <hr>
                <p>Thank you for your purchase!</p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No sale items found.</p>
        <?php endif; ?>
    </div>
</div>