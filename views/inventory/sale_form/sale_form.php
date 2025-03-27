<?php
$today = date('Y-m-d'); // Get today's date
?>

<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Create Sale</h3>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']); ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <noscript>
            <div class="alert alert-warning">
                JavaScript is disabled. Total price will be calculated on submission.
            </div>
        </noscript>
        <form id="newOrderForm" action="/sale_form/store" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="barcode" class="form-label">Barcode</label>
                    <select name="product_id" id="barcode" class="form-control" required>
                        <option value="">Select a Barcode</option>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <option value="<?= htmlspecialchars($product['product_id']) ?>"
                                    data-unit-price="<?= htmlspecialchars($product['unit_price']) ?>">
                                    <?= htmlspecialchars($product['barcode']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>No products available</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="unit_price" class="form-label">Unit Price ($)</label>
                    <input type="text" class="form-control" id="unit_price" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="discount" class="form-label">Discount ($)</label>
                    <input type="number" class="form-control" id="discount" name="discount" min="0" step="0.01" value="0.00">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="total_price" class="form-label">Total Price ($)</label>
                    <input type="text" class="form-control" id="total_price" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="date" class="form-control" id="sale_date" name="sale_date" value="<?= $today; ?>" required>
                </div>
            </div>
            <a href="/dashboard" class="btn btn-secondary" style="margin-right: 10px;">Back</a>
            <button type="submit" class="btn btn-primary">Add Sale</button>
        </form>
    </div>
</div>

<!-- Bootstrap Modal for Receipt -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="receiptContent">
                <!-- Receipt Details will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="window.print()" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("newOrderForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission first

        // Get form values
        const barcode = document.getElementById("barcode").options[document.getElementById("barcode").selectedIndex].text;
        const unitPrice = document.getElementById("unit_price").value;
        const quantity = document.getElementById("quantity").value;
        const discount = document.getElementById("discount").value;
        const totalPrice = document.getElementById("total_price").value;
        const saleDate = document.getElementById("sale_date").value;

        // Validate inputs
        if (!barcode || !unitPrice || quantity <= 0) {
            alert("Please fill out all required fields correctly.");
            return;
        }

        // Generate receipt content
        let receiptContent = `
        <div class="receipt-header text-center mb-4">
            <h3>Store Name</h3>
            <p>123 Store Address, City, Country</p>
            <p>Phone: (123) 456-7890</p>
            <p>Email: store@example.com</p>
            <hr>
        </div>
        <p><strong>Barcode:</strong> ${barcode}</p>
        <p><strong>Unit Price ($):</strong> ${unitPrice}</p>
        <p><strong>Quantity:</strong> ${quantity}</p>
        <p><strong>Discount ($):</strong> ${discount}</p>
        <p><strong>Total Price ($):</strong> ${totalPrice}</p>
        <p><strong>Sale Date:</strong> ${saleDate}</p>
        <hr>
        <p class="text-center"><strong>Status:</strong> Completed</p>
        <p class="text-center"><strong>Thank you for your purchase!</strong></p>
        <p class="text-center">Visit us again!</p>
    `;

        // Insert receipt content and show modal
        document.getElementById("receiptContent").innerHTML = receiptContent;
        var receiptModal = new bootstrap.Modal(document.getElementById('receiptModal'));
        receiptModal.show();

        // Wait for the modal to close, then submit the form
        receiptModal._element.addEventListener('hidden.bs.modal', function() {
            document.getElementById("newOrderForm").submit();
        });
    });
</script>

<!-- JavaScript for Dynamic Unit Price and Total Price Calculation -->
<script>
    const barcodeSelect = document.getElementById("barcode");
    const unitPriceInput = document.getElementById("unit_price");
    const quantityInput = document.getElementById("quantity");
    const discountInput = document.getElementById("discount");
    const totalPriceInput = document.getElementById("total_price");

    function updateTotalPrice() {
        const unitPrice = parseFloat(unitPriceInput.value) || 0;
        const quantity = parseFloat(quantityInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        const totalPrice = (unitPrice * quantity) - discount;
        totalPriceInput.value = totalPrice.toFixed(2);
    }

    barcodeSelect.addEventListener("change", function() {
        const selectedOption = this.options[this.selectedIndex];
        const unitPrice = selectedOption.getAttribute("data-unit-price") || 0;
        unitPriceInput.value = parseFloat(unitPrice).toFixed(2);
        updateTotalPrice();
    });

    quantityInput.addEventListener("input", updateTotalPrice);
    discountInput.addEventListener("input", updateTotalPrice);

    // Client-side validation
    document.getElementById("newOrderForm").addEventListener("submit", function(event) {
        const productId = barcodeSelect.value;
        const quantity = parseInt(quantityInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;

        if (!productId) {
            alert("Please select a barcode.");
            event.prevenpefault();
            return;
        }
        if (quantity <= 0) {
            alert("Quantity must be greater than 0.");
            event.prevenpefault();
            return;
        }
        if (discount < 0) {
            alert("Discount cannot be negative.");
            event.prevenpefault();
            return;
        }
    });
</script>