<?php session_start(); ?>
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>
    <?php $today = date('Y-m-d'); ?>
<?php endif; ?>

<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
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
        <div class="row">

            <!-- List Product Section -->
            <div class="col-lg-8 mb-4 order-0">
                <div class="card shadow-sm border-0 p-4 bg-white">
                    <h3 class="card-title d-flex align-items-center text-primary fw-bold mb-3">
                        <i class="bi bi-cart4 me-2"></i> List Product
                    </h3>
                    <hr class="border-primary">

                    <!-- Order Form -->
                    <form id="newOrderForm" action="/sale_form/store" method="post">
                        <div id="productList" class="mb-4"></div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm p-3 text-center" style="background-color: #ffe6e6;">
                                    <p class="text-muted mt-2 mb-1" style="color: #ff4d4d;">Total Discount</p>
                                    <h5 class="fw-bold" id="discountText" style="color: #ff4d4d;">$0.00
                                        <i class="bi bi-tags fs-3 text-danger me-2"></i>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm p-3 text-center" style="background-color: #d4edda;">
                                    <p class="text-muted mt-2 mb-1" style="color: #28a745;">Total Price</p>
                                    <h5 class="fw-bold" id="totalPrice" style="color: #28a745;">$0.00
                                        <i class="bi bi-cash-stack fs-3 text-success me-2"></i>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end conducts mt-4">
                            <button type="submit" class="btn btn-primary" id="addSaleBtn">
                                <i class="bi bi-cart-plus me-2"></i> Add Sale
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Product Input Section -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100 shadow-lg border-0 rounded">
                    <h3 class="card-title text-primary">Create Sale</h3>
                    <hr>

                    <form id="productForm">
                        <div class="row mb-3">
                            <div class="d-flex align-items-end">
                                <div class="me-2 flex-grow-1 d-flex flex-column">
                                    <label for="barcode" class="form-label">Barcode</label>
                                    <select name="product_id" id="barcode" class="form-control" style="height: 38px;" required>
                                        <option value="">Select a Product</option>
                                        <?php foreach ($products as $product): ?>
                                            <option value="<?= htmlspecialchars($product['product_id']) ?>"
                                                data-unit-price="<?= htmlspecialchars($product['unit_price']) ?>"
                                                data-name="<?= htmlspecialchars($product['name']) ?>"
                                                data-brand="<?= htmlspecialchars($product['brand']) ?>"
                                                data-image-path="<?= !empty($product['image_path']) ? 'assets/img/upload/' . $product['image_path'] : '/path/to/default/image.png' ?>">
                                                <?= htmlspecialchars($product['barcode']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button class="btn btn-success px-4 py-2" type="button" id="saveProductBtn">
                                    <i class="bi bi-save me-2"></i> Save
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Unit Price ($)</label>
                                <input type="text" class="form-control" id="unit_price" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="discount" class="form-label">Discount ($)</label>
                                <input type="number" class="form-control" id="discount" name="discount" min="0" step="0.01" value="0.00">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sale_date" class="form-label">Sale Date</label>
                                <input type="date" class="form-control" id="sale_date" name="sale_date" value="<?= $today; ?>" required>
                            </div>
                        </div>

                        <p class="font-weight-bold text-primary mb-3">Customer Details</p>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-person fs-4 text-secondary me-2"></i>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter Customer Name">
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-phone fs-4 text-success me-2"></i>
                            <input type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number">
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-house-door fs-4 text-danger me-2"></i>
                            <input type="text" class="form-control" id="address" placeholder="Enter Customer Address">
                        </div>
                    </form>
                </div>
            </div>

            <script>
                let productList = [];

                document.getElementById('saveProductBtn').addEventListener('click', function() {
                    const barcodeSelect = document.getElementById('barcode');
                    const selectedOption = barcodeSelect.options[barcodeSelect.selectedIndex];
                    const discountInput = document.getElementById('discount').value;

                    if (!selectedOption.value) {
                        alert("Please select a product.");
                        return;
                    }

                    const imagePath = selectedOption.getAttribute('data-image-path');
                    const basePath = "../../../"; // Adjust based on directory structure
                    const fullImagePath = basePath + imagePath;

                    const newProduct = {
                        barcode: selectedOption.value,
                        name: selectedOption.getAttribute('data-name'),
                        imageUrl: fullImagePath,
                        quantity: 1,
                        price: parseFloat(selectedOption.getAttribute('data-unit-price')),
                        discount: parseFloat(discountInput) || 0
                    };

                    console.log("New Product:", newProduct); // Debugging

                    // Check if product already exists by barcode
                    const existingProductIndex = productList.findIndex(p => p.barcode === newProduct.barcode);
                    if (existingProductIndex !== -1) {
                        // Same product, increase quantity
                        productList[existingProductIndex].quantity += 1;
                    } else {
                        // Different product, add new
                        productList.push(newProduct);
                    }

                    updateProductListUI(productList);
                });

                document.getElementById('addSaleBtn').addEventListener('click', function(e) {
                    e.preventDefault();
                    if (productList.length === 0) {
                        alert("Please save at least one product first.");
                        return;
                    }

                    const customerName = document.getElementById('customer_name').value;
                    const phoneNumber = document.getElementById('phone_number').value;
                    const address = document.getElementById('address').value;
                    const saleDate = document.getElementById('sale_date').value;

                    // Calculate totals for receipt
                    let totalDiscount = 0;
                    let totalPrice = 0;
                    productList.forEach(product => {
                        totalDiscount += product.discount * product.quantity;
                        totalPrice += (product.price - product.discount) * product.quantity;
                    });

                    // Prepare data for AJAX
                    const saleData = {
                        products: productList.map(p => ({
                            product_id: p.barcode, // Using barcode as product_id
                            quantity: p.quantity,
                            sale_date: saleDate,
                            discount: p.discount
                        })),
                        customer_name: customerName,
                        phone_number: phoneNumber,
                        address: address
                    };

                    // Send data to server via AJAX
                    fetch('/sale_form/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(saleData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Generate receipt after successful save
                            const receiptWindow = window.open('', '_blank');
                            receiptWindow.document.write(`
                                <html>
                                <head>
                                    <title>Sale Receipt</title>
                                    <style>
                                        @media print {
                                            .no-print { display: none; }
                                        }
                                        body { 
                                            font-family: Arial, sans-serif; 
                                            padding: 20px; 
                                            margin: 0;
                                        }
                                        .receipt { 
                                            max-width: 400px; 
                                            margin: 0 auto; 
                                            border: 1px solid #000; 
                                            padding: 20px; 
                                        }
                                        h2 { text-align: center; margin-bottom: 20px; }
                                        .details { margin: 10px 0; }
                                        .details p { margin: 5px 0; }
                                        hr { margin: 15px 0; }
                                        .print-btn { 
                                            text-align: center; 
                                            margin-top: 20px; 
                                        }
                                        table { width: 100%; border-collapse: collapse; }
                                        th, td { padding: 5px; text-align: left; }
                                    </style>
                                </head>
                                <body onload="window.print()">
                                    <div class="receipt">
                                        <h2>Sale Receipt</h2>
                                        <div class="details">
                                            <p><strong>Date:</strong> ${saleDate}</p>
                                            <p><strong>Customer:</strong> ${customerName || 'N/A'}</p>
                                            <p><strong>Phone:</strong> ${phoneNumber || 'N/A'}</p>
                                            <p><strong>Address:</strong> ${address || 'N/A'}</p>
                                            <hr>
                                            <table>
                                                <tr><th>Product</th><th>Qty</th><th>Price</th><th>Disc</th><th>Total</th></tr>
                                                ${productList.map(p => `
                                                    <tr>
                                                        <td>${p.name}</td>
                                                        <td>${p.quantity}</td>
                                                        <td>$${p.price.toFixed(2)}</td>
                                                        <td>$${p.discount.toFixed(2)}</td>
                                                        <td>$${(p.price - p.discount).toFixed(2)}</td>
                                                    </tr>
                                                `).join('')}
                                            </table>
                                            <hr>
                                            <p><strong>Total Discount:</strong> $${totalDiscount.toFixed(2)}</p>
                                            <p><strong>Total Amount:</strong> $${totalPrice.toFixed(2)}</p>
                                        </div>
                                    </div>
                                    <div class="print-btn no-print">
                                        <button onclick="window.print()">Print Receipt</button>
                                        <button onclick="window.close()">Close</button>
                                    </div>
                                </body>
                                </html>
                            `);
                            receiptWindow.document.close();

                            // Clear the product list after successful save
                            productList = [];
                            updateProductListUI(productList);
                        } else {
                            alert("Failed to save sale: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("An error occurred while saving the sale.");
                    });
                });

                function updateProductListUI(products) {
                    const productListElement = document.getElementById('productList');
                    productListElement.innerHTML = '';

                    let totalDiscount = 0;
                    let totalPrice = 0;

                    products.forEach(product => {
                        const productTotal = (product.price - product.discount) * product.quantity;
                        totalDiscount += product.discount * product.quantity;
                        totalPrice += productTotal;

                        productListElement.innerHTML += `
                            <div class="d-flex align-items-center gap-4 p-3 rounded mb-4" style="background-color: rgb(222, 238, 255);">
                                <img src="${product.imageUrl}" alt="Product Image" class="rounded" style="width: 70px; height: 70px;" />
                                <div class="d-flex flex-column">
                                    <p class="mb-1"><strong>Product Name:</strong> <span class="text-dark">${product.name}</span></p>
                                    <p class="mb-1"><strong>Quantity:</strong> <span class="text-dark">${product.quantity}</span></p>
                                    <p class="mb-0"><strong>Price:</strong> <span class="text-primary fw-bold">$${productTotal.toFixed(2)}</span></p>
                                </div>
                            </div>
                        `;
                    });

                    document.getElementById('discountText').innerHTML = 
                        `$${totalDiscount.toFixed(2)} <i class="bi bi-tags fs-3 text-danger me-2"></i>`;
                    document.getElementById('totalPrice').innerHTML = 
                        `$${totalPrice.toFixed(2)} <i class="bi bi-cash-stack fs-3 text-success me-2"></i>`;
                }

                document.getElementById('barcode').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (!selectedOption.value) {
                        document.getElementById('unit_price').value = "";
                        document.getElementById('name').value = "";
                        return;
                    }

                    document.getElementById('unit_price').value = parseFloat(selectedOption.getAttribute('data-unit-price')).toFixed(2);
                    document.getElementById('name').value = selectedOption.getAttribute('data-name');
                });
            </script>
        </div>
    </div>
</div>