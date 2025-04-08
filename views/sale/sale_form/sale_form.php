<?php session_start(); ?>
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>
    <?php $today = date('Y-m-d'); ?>

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
                                    <input type="text" id="barcode" class="form-control" style="height: 38px;" placeholder="Enter Barcode" required>
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
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-credit-card fs-4 text-danger me-2"></i>
                            <select class="form-control" id="payment_method" placeholder="Select Payment Method" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="qr_scan">QR Scan</option>
                                <option value="card">Card</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- input barcode -->
            <script>
                // Function to handle barcode input and product search
                const products = <?= json_encode($products) ?>; // Convert PHP array to JS object
                
                document.getElementById('barcode').addEventListener('input', function() {
                    let barcodeValue = this.value.trim();
                    let product = products.find(p => p.barcode === barcodeValue);

                    if (product) {
                        console.log("Product found:", product);
                        document.getElementById('name').value = product.name;
                        document.getElementById('unit_price').value = product.unit_price;
                        document.getElementById('discount').value = product.discount || 0;
                    } else {
                        document.getElementById('name').value = '';
                        document.getElementById('unit_price').value = '';
                        document.getElementById('discount').value = 0;
                    }
                });

                // Function to update the product list UI
                function updateProductListUI(products) {
                    const productListElement = document.getElementById('productList');
                    productListElement.innerHTML = '';

                    let totalDiscount = 0; 
                    let totalPrice = 0;

                    // Render each product in the list
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

                    // Update total discount and price in the UI
                    document.getElementById('discountText').innerHTML = 
                        `$ ${totalDiscount.toFixed(2)} <i class="bi bi-tags fs-3 text-danger me-2"></i>`;
                    document.getElementById('totalPrice').innerHTML = 
                        `$ ${totalPrice.toFixed(2)} <i class="bi bi-cash-stack fs-3 text-success me-2"></i>`;

                    // Store the product list in local storage
                    localStorage.setItem('productList', JSON.stringify(products));
                }

                // Load product list from local storage on page load
                document.addEventListener('DOMContentLoaded', function() {
                    const storedProducts = localStorage.getItem('productList');
                    if (storedProducts) {
                        productList = JSON.parse(storedProducts);
                        updateProductListUI(productList);
                    }
                });

                // Function to find product ID based on barcode
                function findProductID(barcode) {
                    const product = products.find(p => p.barcode === barcode);
                    return product ? product.id : null; // Return product ID or null if not found
                }

                // Function to catch image path based on barcode
                function catchImagePath(barcode) {
                    const product = products.find(p => p.barcode === barcode);
                    // If product exists and has image_path, return it - otherwise return default path
                    return product && product.image_path 
                        ? `/assets/img/upload/${product.image_path}` 
                        : `/assets/img/upload/default.png`; // Default image if no image_path exists
                }


                // Initialize product list
                let productList = [];

                // Event listener for saving a product
                document.getElementById('saveProductBtn').addEventListener('click', function() {
                    const barcodeInput = document.getElementById('barcode');
                    const discountInput = document.getElementById('discount').value;

                    // Construct the image path
                    const fullImagePath = catchImagePath(barcodeInput.value); // Replace with actual logic if needed

                    // Create a new product object
                    const newProduct = {
                        id: findProductID(barcodeInput.value), // Assuming you have a function to find the product ID
                        barcode: barcodeInput.value,
                        name: document.getElementById('name').value,
                        imageUrl: fullImagePath,
                        quantity: 1,
                        price: parseFloat(document.getElementById('unit_price').value) || 0,
                        discount: parseFloat(discountInput) || 0
                    };

                    console.log("New Product:", newProduct); // Debugging

                    // Check if the product already exists in the list
                    const existingProductIndex = productList.findIndex(p => p.barcode === newProduct.barcode);
                    if (existingProductIndex !== -1) {
                        // If the product exists, increase its quantity
                        productList[existingProductIndex].quantity += 1;
                    } else {
                        // If the product is new, add it to the list
                        productList.push(newProduct);
                    }

                    
                        // Update the UI with the updated product list
                        updateProductListUI(productList);
                    
                    
                    

                    // Clear the form inputs
                    barcodeInput.value = '';
                    document.getElementById('name').value = '';
                    document.getElementById('unit_price').value = '';
                    document.getElementById('discount').value = '0.00';
                });

                function getSaleData() {
                    // Retrieve the product list from local storage
                    const productList = JSON.parse(localStorage.getItem('productList')) || [];
                    const jsonFormat = JSON.stringify(productList, null, 4); // pretty JSON format

                    // Create the sale data object in your exact specified format
                    const saleData = {
                        "sale_id": "01",
                        "user_id": "pnc-1",
                        "customer": [
                            {
                                "name": document.getElementById('customer_name').value,
                                "phone_number": document.getElementById('phone_number').value,
                                "address": document.getElementById('address').value
                            }
                        ],
                        "products": jsonFormat,
                        "sub_price": ,
                        "total_discount": document.getElementById('discountText').textContent.trim(),
                        "total_price": document.getElementById('totalPrice').textContent.trim(), // Note: This is hardcoded as in your example
                        "sale_item_id": "01",
                        "sale_date": document.getElementById('sale_date').value,
                        "sale_status": "complete",
                        "payment": document.getElementById('payment_method').value
                    };
                    
                    return saleData;
                }

                // Add to sale button event listener
                document.getElementById('addSaleBtn').addEventListener('click', function(event) {
                    event.preventDefault();
                    
                    const storedProducts = localStorage.getItem('productList');
                    if (storedProducts) {
                        const saleData = getSaleData();
                        
                        // Display the JSON data in alert (formatted)
                        alert(JSON.stringify(saleData, null, 4));
                        
                        // For debugging in console
                        console.log("Sale Data:", saleData);
                    } else {
                        alert("No products found in the sale.");
                    }

                    // Clear the product list from local storage
                    localStorage.removeItem('productList');
                });
            </script>
        </div>
    </div>
</div>
<?php else: ?>
<?php $this->redirect('/login'); ?>
<?php endif; ?>