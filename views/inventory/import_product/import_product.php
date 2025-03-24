<div class="container mt-5">
    <h1 class="mb-4 text-center">Import Product</h1>
    <div class="card shadow-lg">
        <div class="card-body">
            <form id="importProductForm" action="/your-endpoint" method="POST" enctype="multipart/form-data">

                <!-- Product Information and Pricing Section -->
                <div class="mb-5">
                    <h5 class="section-title text-primary mb-3">Product Information & Pricing</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="productName" placeholder="Enter product title" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Barcode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="barcode" placeholder="e.g. 0123-4567" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="brand" placeholder="Brand Name" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Order Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="orderDate" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Expected Delivery <span class="text-danger">*</span></label>
                            <select class="form-control" name="expectedDelivery" required>
                                <option value="">Select Status</option>
                                <option value="Order">Order</option>
                                <option value="Delivery">Delivery</option>
                                <option value="Arrived">Arrived</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Product Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="productStatus" required>
                                <option value="">Select Status</option>
                                <option value="Ready">Ready</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Organization Section -->
                <div class="mb-5">
                    <h5 class="section-title text-primary mb-3">Organization</h5>
                    <div class="row">
                    <?php
                        $categoryModel = new CategoryModel();

                        // Fetch categories from the database
                        $categories = $categoryModel->getCategories();
                    ?>

                    <!-- Your HTML Form with Category Dropdown -->
                    <div class="col-md-4 mb-4">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select" name="category" id="category" required>
                            <option selected>Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['category_id']); ?>">
                                    <?= htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                        <div class="col-md-4 mb-4">
                            <label class="form-label">Model<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="model" placeholder="Enter model name">
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Vendor<span class="text-danger">*</span></label>
                            <select class="form-select" name="vendor">
                                <option selected>Select Vendor</option>
                                <option>Apple</option>
                                <option>Samsung</option>
                                <option>Oppo</option>
                                <option>Vivo</option>
                                <option>Huawei</option>
                                <option>Realme</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select class="form-select" name="status">
                                <option selected>Select Status</option>
                                <option>New</option>
                                <option>First Hand</option>
                                <option>Second Hand</option>
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
                            <input type="number" class="form-control" name="basePriceUSD" id="basePriceUSD" placeholder="Enter price in USD" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Base Price (KHR) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="basePriceKHR" id="basePriceKHR" placeholder="Enter price in KHR" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Exchange Rate (USD to KHR) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="exchangeRate" placeholder="Enter exchange rate" value="4000" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Total Price (USD)</label>
                        <input type="text" class="form-control" name="totalPriceUSD" id="totalPriceUSD" placeholder="Total price in USD" readonly>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Total Price (KHR)</label>
                        <input type="text" class="form-control" name="totalPriceKHR" id="totalPriceKHR" placeholder="Total price in KHR" readonly>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">Submit Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function convertBasePrice() {
        let usdInput = document.getElementById('basePriceUSD');
        let khrInput = document.getElementById('basePriceKHR');
        let exchangeRate = parseFloat(document.getElementById('exchangeRate').value) || 4000;

        if (document.activeElement === usdInput) {
            let usdValue = parseFloat(usdInput.value) || 0;
            khrInput.value = (usdValue * exchangeRate).toFixed(0);
        } else if (document.activeElement === khrInput) {
            let khrValue = parseFloat(khrInput.value) || 0;
            usdInput.value = (khrValue / exchangeRate).toFixed(2);
        }
    updateTotalPrice();
    }

    function updateTotalPrice() {
        let basePriceUSD = parseFloat(document.getElementById('basePriceUSD').value) || 0;
        let quantity = parseInt(document.getElementById('quantity').value) || 0;
        let exchangeRate = parseFloat(document.getElementById('exchangeRate').value) || 4000;

        let totalPriceUSD = basePriceUSD * quantity;
        let totalPriceKHR = totalPriceUSD * exchangeRate;

            document.getElementById('totalPriceUSD').value = totalPriceUSD.toFixed(2);
            document.getElementById('totalPriceKHR').value = totalPriceKHR.toFixed(0);
        }

        document.getElementById('basePriceUSD').addEventListener('input', convertBasePrice);
        document.getElementById('basePriceKHR').addEventListener('input', convertBasePrice);
        document.getElementById('quantity').addEventListener('input', updateTotalPrice);
        document.getElementById('exchangeRate').addEventListener('input', convertBasePrice);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get today's date in YYYY-MM-DD format
        let today = new Date().toISOString().split('T')[0];

        // Set the order date input field to today's date
        document.getElementsByName('orderDate')[0].value = today;
    });
</script>

