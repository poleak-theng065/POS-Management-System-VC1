
<div class="container mt-5">
    <h1 class="mb-4 text-center">Edit Product</h1>
    <div class="card shadow-lg">
        <div class="card-body">
            <form id="editProductForm" action="/order_new_product/update/<?= htmlspecialchars($newOrder['id']) ?>" method="POST" enctype="multipart/form-data">

                <!-- Product Information and Pricing Section -->
                <div class="mb-5">
                    <h5 class="section-title text-primary mb-3">Product Information & Pricing</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="productName" value="<?= htmlspecialchars($newOrder['name']); ?>" placeholder="Enter product title">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Barcode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="barcode" value="<?= htmlspecialchars($newOrder['barcode']); ?>" placeholder="e.g. 0123-4567">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="brand" value="<?= htmlspecialchars($newOrder['brand']); ?>" placeholder="Brand Name">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Order Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="orderDate" value="<?= htmlspecialchars($newOrder['order_date']); ?>">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Expected Delivery <span class="text-danger">*</span></label>
                            <select class="form-control" name="expectedDelivery">
                                <option value="Order" <?= $newOrder['expected_delivery'] == 'Order' ? 'selected' : ''; ?>>Order</option>
                                <option value="Delivery" <?= $newOrder['expected_delivery'] == 'Delivery' ? 'selected' : ''; ?>>Delivery</option>
                                <option value="Arrived" <?= $newOrder['expected_delivery'] == 'Arrived' ? 'selected' : ''; ?>>Arrived</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="Ready" <?= $newOrder['status'] == 'Ready' ? 'selected' : ''; ?>>Ready</option>
                                <option value="Pending" <?= $newOrder['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Organization Section -->
                <div class="mb-5">
                    <h5 class="section-title text-primary mb-3">Organization</h5>
                    <div class="row">
                        <?php
                            // Fetch categories for the dropdown
                            $categoryModel = new CategoryModel();
                            $categories = $categoryModel->getCategories();
                        ?>

                        <!-- Category Dropdown -->
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="category" id="category">
                                <!-- <option value="">Select Category</option> -->
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['category_id']); ?>"
                                        <?= isset($newOrder['category_id']) && $category['category_id'] == $newOrder['category_id'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Model<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="model" value="<?= htmlspecialchars($newOrder['model']); ?>" placeholder="Enter model name">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Vendor<span class="text-danger">*</span></label>
                            <select class="form-select" name="supplier">
                                <option value="Apple" <?= $newOrder['supplier'] == 'Apple' ? 'selected' : ''; ?>>Apple</option>
                                <option value="Samsung" <?= $newOrder['supplier'] == 'Samsung' ? 'selected' : ''; ?>>Samsung</option>
                                <option value="Oppo" <?= $newOrder['supplier'] == 'Oppo' ? 'selected' : ''; ?>>Oppo</option>
                                <option value="Vivo" <?= $newOrder['supplier'] == 'Vivo' ? 'selected' : ''; ?>>Vivo</option>
                                <option value="Huawei" <?= $newOrder['supplier'] == 'Huawei' ? 'selected' : ''; ?>>Huawei</option>
                                <option value="Realme" <?= $newOrder['supplier'] == 'Realme' ? 'selected' : ''; ?>>Realme</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select class="form-select" name="productStatus">
                                <!-- <option selected>Select Status</option> -->
                                <option value="New" <?= $newOrder['product_status'] == 'New' ? 'selected' : ''; ?>>New</option>
                                <option value="First Hand" <?= $newOrder['product_status'] == 'First Hand' ? 'selected' : ''; ?>>First Hand</option>
                                <option value="Second Hand" <?= $newOrder['product_status'] == 'Second Hand' ? 'selected' : ''; ?>>Second Hand</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Product Pricing Section -->
                <div class="mb-5">
                    <h5 class="section-title text-primary mb-3">Product Pricing</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Base Price (USD) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="basePriceUSD" id="basePriceUSD" value="<?= htmlspecialchars($newOrder['base_price_usd']); ?>" placeholder="Enter price in USD">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Base Price (KHR) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="basePriceKHR" id="basePriceKHR" value="<?= htmlspecialchars($newOrder['base_price_kh']); ?>" placeholder="Enter price in KHR">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="quantity" id="quantity" value="<?= htmlspecialchars($newOrder['quantity']); ?>" placeholder="Enter quantity">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Exchange Rate (USD to KHR) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="exchangeRate" value="4000">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Total Price (USD)</label>
                        <input type="text" class="form-control" name="totalPriceUSD" id="totalPriceUSD" 
                            value="<?= isset($newOrder['totalPriceUSD']) ? htmlspecialchars($newOrder['totalPriceUSD']) : ''; ?>" 
                            placeholder="Total price in USD" readonly>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Total Price (KHR)</label>
                        <input type="text" class="form-control" name="totalPriceKHR" id="totalPriceKHR" 
                            value="<?= isset($newOrder['totalPriceKHR']) ? htmlspecialchars($newOrder['totalPriceKHR']) : ''; ?>" 
                            placeholder="Total price in KHR" readonly>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a> <!-- Cancel Button -->
                    <button type="submit" class="btn btn-primary">Submit Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to convert base price from USD to KHR
    function convertBasePrice() {
        const basePriceUSD = parseFloat(document.getElementById('basePriceUSD').value);
        const exchangeRate = parseFloat(document.getElementById('exchangeRate').value);

        if (!isNaN(basePriceUSD) && !isNaN(exchangeRate)) {
            const basePriceKHR = basePriceUSD * exchangeRate;
            document.getElementById('basePriceKHR').value = basePriceKHR.toFixed(2);

            // Update total prices
            const quantity = parseInt(document.getElementById('quantity').value);
            if (!isNaN(quantity)) {
                const totalPriceUSD = basePriceUSD * quantity;
                const totalPriceKHR = basePriceKHR * quantity;
                document.getElementById('totalPriceUSD').value = totalPriceUSD.toFixed(2);
                document.getElementById('totalPriceKHR').value = totalPriceKHR.toFixed(2);
            }
        }
    }

    // Event listeners for inputs
    document.getElementById('basePriceUSD').addEventListener('input', convertBasePrice);
    document.getElementById('quantity').addEventListener('input', convertBasePrice);

    // Ensure initial values are calculated on page load (for editing)
    window.addEventListener('load', convertBasePrice);

</script>
