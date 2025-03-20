<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h2>Receipt</h2>
    <p><strong>Customer Name:</strong> <?= htmlspecialchars($customerName) ?></p>
    <p><strong>Phone Number:</strong> <?= htmlspecialchars($phoneNumber) ?></p>
    <p><strong>Product Name:</strong> <?= htmlspecialchars($product['description']) ?></p>
    <p><strong>Price:</strong> $<?= number_format($product['unit_price'], 2) ?></p>
    <p><strong>Discount:</strong> <?= htmlspecialchars($discount) ?>%</p>
    <p><strong>Total Amount:</strong> $<?= number_format($totalAmount, 2) ?></p>
    <p><strong>Sale Date:</strong> <?= htmlspecialchars($saleDate) ?></p>
    <p><strong>Status:</strong> Completed</p>
    <hr>
    <p>Thank you for your purchase!</p>
</body>
</html>