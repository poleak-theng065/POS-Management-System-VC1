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
                        <div id="productList" class="mb-4" style="height: 250px; overflow-y: auto; border: 1px solid #ddd; border-radius: 5px; padding: 10px;">
                        </div>

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

                        <div class="d-flex justify-content-end mt-4">
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
                                    <input type="text" name="product_id" id="barcode" class="form-control" placeholder="Scan or enter barcode" required>
                                </div>
                                <button class="btn btn-success px-4 py-2" type="button" id="saveProductBtn">
                                    <i class="bi bi-save me-2"></i> Save
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" required readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unit_price" class="form-label">Unit Price ($)</label>
                                <input type="text" class="form-control" id="unit_price" required readonly>
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
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method">
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="mobile_payment">Mobile Payment</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Previous PHP/HTML code remains the same until the JavaScript section -->
            <script>
                let productList = [];
                const productsData = <?= json_encode($products) ?>;
                
                // Create barcode to product mapping
                const productMap = {};
                productsData.forEach(product => {
                    productMap[product.barcode] = {
                        product_id: product.product_id,
                        name: product.name,
                        brand: product.brand,
                        unit_price: product.unit_price,
                        image_path: product.image_path ? 'assets/img/upload/' + product.image_path : '/path/to/default/image.png'
                    };
                });

                // Auto-focus barcode input on page load
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('barcode').focus();
                });

                // Handle barcode input changes
                document.getElementById('barcode').addEventListener('input', function() {
                    const barcode = this.value.trim();
                    const product = productMap[barcode];
                    
                    if (product) {
                        document.getElementById('unit_price').value = parseFloat(product.unit_price).toFixed(2);
                        document.getElementById('name').value = product.name;
                    } else {
                        document.getElementById('unit_price').value = "";
                        document.getElementById('name').value = "";
                    }
                });

                // Handle Enter key in barcode field
                document.getElementById('barcode').addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        document.getElementById('saveProductBtn').click();
                    }
                });

                // Save product button handler
                document.getElementById('saveProductBtn').addEventListener('click', function() {
                    const barcodeInput = document.getElementById('barcode');
                    const barcode = barcodeInput.value.trim();
                    const discountInput = parseFloat(document.getElementById('discount').value) || 0;

                    if (!barcode) {
                        alert("Please enter a barcode.");
                        return;
                    }

                    const product = productMap[barcode];
                    if (!product) {
                        alert("Product not found for this barcode.");
                        return;
                    }

                    const basePath = "../../../";
                    const fullImagePath = basePath + product.image_path;

                    const newProduct = {
                        barcode: product.product_id,
                        name: product.name,
                        imageUrl: fullImagePath,
                        quantity: 1,
                        price: parseFloat(product.unit_price),
                        discount: discountInput
                    };

                    // Check if product exists - UPDATED SECTION
                    const existingIndex = productList.findIndex(p => p.barcode === newProduct.barcode);
                    if (existingIndex !== -1) {
                        productList[existingIndex].quantity += 1;
                        // Keep discount as per-unit value
                        productList[existingIndex].discount = discountInput; 
                    } else {
                        productList.push(newProduct);
                    }
                    updateProductListUI(productList, existingIndex !== -1 ? existingIndex : productList.length - 1);

                    // Reset for next entry
                    barcodeInput.value = '';
                    barcodeInput.focus();
                    document.getElementById('discount').value = '0.00';
                });

                // Update product list UI
                function updateProductListUI(products, scrollToIndex) {
                    const productListElement = document.getElementById('productList');
                    productListElement.innerHTML = '';

                    let totalDiscount = 0;
                    let totalPrice = 0;

                    products.forEach((product, index) => {
                        const productTotal = (product.price - product.discount) * product.quantity;
                        totalDiscount += product.discount * product.quantity;
                        totalPrice += productTotal;

                        const productDiv = document.createElement('div');
                        productDiv.className = "d-flex align-items-center gap-3 p-3 mb-3 rounded";
                        productDiv.style.backgroundColor = "#e7f3ff";
                        productDiv.style.border = "1px solid #b3d7ff";
                        productDiv.style.borderRadius = "8px";

                        productDiv.innerHTML = `
                            <img src="${product.imageUrl}" alt="Product Image" class="rounded" style="width: 70px; height: 70px; object-fit: cover;" />
                            <div class="flex-grow-1">
                                <p class="mb-1" style="font-weight: 600; font-size: 1.1em; color: #333;">
                                    <strong>${product.name}</strong>
                                </p>
                                <p class="mb-0" style="font-size: 0.9em; color: #555;">
                                    <strong>Quantity:</strong> <span class="text-dark">${product.quantity}</span> | 
                                    <strong>Price:</strong> $${product.price.toFixed(2)} | 
                                    <strong>Disc:</strong> $${product.discount.toFixed(2)} | 
                                    <strong>Total:</strong> <span class="text-success fw-bold">$${productTotal.toFixed(2)}</span>
                                </p>
                            </div>
                        `;

                        productListElement.appendChild(productDiv);

                        if (index === scrollToIndex) {
                            productDiv.scrollIntoView({ behavior: "smooth", block: "nearest" });
                        }
                    });

                    document.getElementById('discountText').innerHTML = 
                        `$${totalDiscount.toFixed(2)} <i class="bi bi-tags fs-3 text-danger me-2"></i>`;
                    document.getElementById('totalPrice').innerHTML = 
                        `$${totalPrice.toFixed(2)} <i class="bi bi-cash-stack fs-3 text-success me-2"></i>`;
                }

                // Handle sale submission - FINAL WORKING VERSION
                document.getElementById('addSaleBtn').addEventListener('click', async function(e) {
                    e.preventDefault();
                    
                    // Validate products
                    if (productList.length === 0) {
                        alert("Please add at least one product");
                        return;
                    }

                    // Calculate totals
                    const totals = productList.reduce((acc, product) => {
                        acc.subtotal += (product.price * product.quantity);
                        acc.discount += (product.discount * product.quantity);
                        return acc;
                    }, { subtotal: 0, discount: 0 });

                    // Prepare sale data
                    const saleData = {
                        payment_method: document.getElementById('payment_method').value || 'cash',
                        customer_name: document.getElementById('customer_name').value || 'Walk-In-Customer',
                        phone_number: document.getElementById('phone_number').value || '',
                        address: document.getElementById('address').value || '',
                        total_amount: totals.subtotal - totals.discount,
                        total_discount: totals.discount,
                        items: productList.map(item => ({
                            product_id: item.barcode,
                            quantity: item.quantity,
                            unit_price: item.price,
                            discount: item.discount
                        }))
                    };

                    try {
                        console.log("Sending sale data:", saleData);
                        
                        const response = await fetch('/sale_form/store', {
                            method: 'POST',
                            headers: { 
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify(saleData)
                        });

                        // First get the response text
                        const responseText = await response.text();
                        
                        // Try to parse as JSON
                        let result;
                        try {
                            result = JSON.parse(responseText);
                        } catch  {
                            // If parsing fails, log the response text for debugging
                            throw new Error(`Server returned invalid JSON: ${responseText.substring(0, 100)}`);
                        }

                        console.log("Response data:", result);
                        
                        if (!response.ok) {
                            throw new Error(result.message || `Server returned status ${response.status}`);
                        }

                        if (!result.success) {
                            throw new Error(result.message || "Unknown error occurred");
                        }

                        // Success case
                        generateReceipt(
                            new Date().toLocaleString(),
                            saleData.customer_name,
                            saleData.phone_number,
                            saleData.address,
                            productList,
                            totals.discount,
                            totals.subtotal - totals.discount
                        );
                        
                        // Reset form
                        productList = [];
                        updateProductListUI(productList);
                        document.getElementById('customer_name').value = '';
                        document.getElementById('phone_number').value = '';
                        document.getElementById('address').value = '';
                        
                        alert(`Sale #${result.sale_id} completed successfully!`);
                        
                    } catch (error) {
                        console.error('Full error details:', error);
                        alert('Sale failed: ' + error.message);
                    }
                });

                // Generate receipt (updated function with all required parameters)
                function generateReceipt(date, customer, phone, address, products, totalDiscount, totalPrice) {
                    const receiptWindow = window.open('', '_blank');
                    
                    // Build products table rows
                    const productRows = products.map(p => `
                        <tr>
                            <td>${p.name}</td>
                            <td>${p.quantity}</td>
                            <td>$${p.price.toFixed(2)}</td>
                            <td>$${p.discount.toFixed(2)}</td>
                            <td>$${(p.price * p.quantity - p.discount).toFixed(2)}</td>
                        </tr>
                    `).join('');
                    
                    receiptWindow.document.write(`
                        <html>
                        <head>
                            <title>Digital Invoice</title>
                            <style>
                                @media print { 
                                    .no-print { display: none; } 
                                    body { font-size: 12px; }
                                }
                                body { 
                                    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif; 
                                    padding: 0;
                                    margin: 0;
                                    background-color: #f8f9fa;
                                    color: #333;
                                }
                                .invoice-container { 
                                    max-width: 500px; 
                                    margin: 20px auto; 
                                    background: white;
                                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                                    border-radius: 8px;
                                    overflow: hidden;
                                }
                                .invoice-header {
                                    background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
                                    color: white;
                                    padding: 25px;
                                    text-align: center;
                                }
                                .invoice-header h1 {
                                    margin: 0;
                                    font-size: 1.8em;
                                    font-weight: 600;
                                }
                                .invoice-header p {
                                    margin: 5px 0 0;
                                    opacity: 0.9;
                                    font-size: 0.9em;
                                }
                                .invoice-body {
                                    padding: 25px;
                                }
                                .invoice-info {
                                    display: flex;
                                    justify-content: space-between;
                                    flex-direction: column;
                                    margin-bottom: 20px;
                                    flex-wrap: wrap;
                                }
                                .info-block {
                                    margin-bottom: 15px;
                                    display: flex;
                                    flex-direction: row;
                                    gap: 5px;
                                }
                                .info-block h3 {
                                    margin: 0 0 5px;
                                    font-size: 1em;
                                    color: #666;
                                }
                                .info-block p {
                                    margin: 0;
                                    font-weight: 500;
                                }
                                .divider {
                                    height: 1px;
                                    background: linear-gradient(to right, transparent, #ddd, transparent);
                                    margin: 20px 0;
                                }
                                table {
                                    width: 100%; 
                                    border-collapse: collapse;
                                    font-size: 0.95em;
                                }
                                th {
                                    text-align: left;
                                    padding: 12px 8px;
                                    background-color: #f5f7ff;
                                    color: #555;
                                    font-weight: 600;
                                    text-transform: uppercase;
                                    font-size: 0.8em;
                                    letter-spacing: 0.5px;
                                }
                                td {
                                    padding: 12px 8px;
                                    border-bottom: 1px solid #eee;
                                }
                                .text-right {
                                    text-align: right;
                                }
                                .total-row {
                                    font-weight: bold;
                                    background-color: #f9f9f9;
                                }
                                .total-row td {
                                    border-bottom: none;
                                    padding-top: 15px;
                                    padding-bottom: 15px;
                                }
                                .grand-total {
                                    font-size: 1.1em;
                                    color: #000DFF;
                                }
                                .footer {
                                    text-align: center;
                                    padding: 15px;
                                    color: #777;
                                    font-size: 0.85em;
                                    background-color: #f8f9fa;
                                    border-top: 1px solid #eee;
                                }
                                .no-print {
                                    text-align: center;
                                    margin: 20px auto;
                                    max-width: 500px;
                                }
                                button {
                                    padding: 10px 20px;
                                    border: none;
                                    border-radius: 6px;
                                    font-weight: 500;
                                    cursor: pointer;
                                    transition: all 0.2s;
                                    margin: 0 5px;
                                }
                                .print-btn {
                                    background: #4CAF50;
                                    color: white;
                                }
                                .print-btn:hover {
                                    background: #3e8e41;
                                }
                                .close-btn {
                                    background: #f44336;
                                    color: white;
                                }
                                .close-btn:hover {
                                    background: #d32f2f;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="invoice-container">
                                <div class="invoice-header">
                                    <h1>HENG HENG</h1>
                                    <p>Phnom Penh, Cambodia | +855 123 456 789</p>
                                </div>
                                
                                <div class="invoice-body">
                                    <div class="invoice-info">
                                        <div class="info-block">
                                            <h3>Invoice Date: </h3>
                                            <p>${date}</p>
                                        </div>
                                        <div class="info-block">
                                            <h3>Customer: </h3>
                                            <p>${customer || 'Walk-in Customer'}</p>
                                        </div>
                                        <div class="info-block">
                                            <h3>Phone: </h3>
                                            <p>${phone || 'N/A'}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="divider"></div>
                                    
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Disc</th>
                                                <th class=>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${productRows}
                                        </tbody>
                                        <tfoot>
                                            <tr class="total-row">
                                                <td colspan="4">Subtotal</td>
                                                <td class="text-right">$${(totalPrice + totalDiscount).toFixed(2)}</td>
                                            </tr>
                                            <tr class="total-row">
                                                <td colspan="4">Total Discount</td>
                                                <td class="text-right">-$${totalDiscount.toFixed(2)}</td>
                                            </tr>
                                            <tr class="total-row grand-total">
                                                <td colspan="4">Amount Due</td>
                                                <td class="text-right">$${totalPrice.toFixed(2)}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                                <div class="footer">
                                    Thank you for your business! | Terms & Conditions Apply
                                </div>
                            </div>
                            
                            <div class="no-print">
                                <button onclick="window.print()" class="print-btn">Print Invoice</button>
                                <button onclick="window.close()" class="close-btn">Close Window</button>
                            </div>
                        </body>
                        </html>
                        
                    `);
                    receiptWindow.document.close();
                }
            </script>
        </div>
    </div>
</div>