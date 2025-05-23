<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Create New Product</h3>
        <form action="/product_list/store" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="barcode">Barcode</label>
                    <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Enter product barcode" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="image">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                    <!-- Fixed duplicate id "name" to "image" -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter product brand" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Enter product model" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type">Type</label>
                    <input type="text" class="form-control" id="type" name="type" placeholder="Enter product type" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="new">New</option>
                        <option value="first-hand">First Hand</option>
                        <option value="second-hand">Second Hand</option>
                    </select>
                    <!-- Added required attribute -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter stock quantity" required>
                    <!-- Added min="0" to prevent negative numbers -->
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-control" id="category_id" required>
                        <option value="">Select a Category</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['category_id']) ?>">
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>No categories available</option>
                        <?php endif; ?>
                    </select>
                    <!-- Added id="category_id" -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="unit_price" name="unit_price" placeholder="Enter unit price" required>
                    <!-- Added min="0" -->
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cost_price">Cost Price</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="cost_price" name="cost_price" placeholder="Enter cost price" required>
                    <!-- Added min="0" -->
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Product Description"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Product</button>
                <a href="/product_list" class="btn btn-secondary">Discard</a>
                <!-- Removed type="button" as it's not needed for anchor tag -->
            </div>
        </form>
    </div>
</div>