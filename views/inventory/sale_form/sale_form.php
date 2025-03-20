<?php
    $today = date('Y-m-d'); // Get today's date
?>

<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Create Sale</h3>
        <form id="newOrderForm" action="generate_receipt.php" method="post">
            <div class="mb-3">
                <label for="customerName" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customerName" name="customerName" required placeholder="Enter customer name">
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required placeholder="Enter phone number">
            </div>
            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" required placeholder="Enter barcode">
            </div>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" readonly>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="text" class="form-control" id="price" name="price" readonly>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" value="0">
            </div>
            <div class="mb-3">
                <label for="saleDate" class="form-label">Sale Date</label>
                <input type="date" class="form-control" id="saleDate" name="saleDate" value="<?= $today; ?>" required>
            </div>
            <a href="javascript:history.back()" class="btn btn-secondary" style="margin-right: 10px;">Back</a>
            <button type="submit" class="btn btn-primary">Add Sale</button>
        </form>
    </div>
</div>

<!-- JavaScript for Fetching Product Details -->
<script>
document.getElementById("barcode").addEventListener("change", function () {
    let barcode = this.value;

    if (barcode.trim() !== "") {
        fetch("fetch_product.php?barcode=" + barcode)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("productName").value = data.product_name;
                    document.getElementById("price").value = data.price;
                } else {
                    alert("Product not found!");
                    document.getElementById("productName").value = "";
                    document.getElementById("price").value = "";
                }
            })
            .catch(error => console.error("Error:", error));
    }
});
</script>
