<!-- Card for Editing Product -->
<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Edit Product</h3>
        <form action="/product_list/update/<?= $product['product_id'] ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="edit-barcode">Barcode</label>
                    <input type="text" class="form-control" id="edit-barcode" name="barcode" value="<?= htmlspecialchars($product['barcode']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="edit-name">Product Name</label>
                    <input type="text" class="form-control" id="edit-name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="edit-image">Product Image</label>
                    <input type="file" class="form-control" id="edit-image" name="image">
                    <small class="text-muted">Current image: <?= htmlspecialchars($product['image'] ?? 'No image') ?></small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit-brand">Brand</label>
                    <input type="text" class="form-control" id="edit-brand" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit-model">Model</label>
                    <input type="text" class="form-control" id="edit-model" name="model" value="<?= htmlspecialchars($product['model']) ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit-type">Type</label>
                    <input type="text" class="form-control" id="edit-type" name="type" value="<?= htmlspecialchars($product['type']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit-status">Status</label>
                    <select class="form-control" id="edit-status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="new" <?= $product['status'] == 'new' ? 'selected' : '' ?>>New</option>
                        <option value="first-hand" <?= $product['status'] == 'first-hand' ? 'selected' : '' ?>>First Hand</option>
                        <option value="second-hand" <?= $product['status'] == 'second-hand' ? 'selected' : '' ?>>Second Hand</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit-stock-quantity">Stock Quantity</label>
                    <input type="number" min="0" class="form-control" id="edit-stock-quantity" name="stock_quantity" value="<?= htmlspecialchars($product['stock_quantity']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit-category">Category</label>
                    <select class="form-control" id="edit-category" name="category_id" required>
                        <option value="">Select a Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['category_id']) ?>" <?= $category['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit-unit-price">Unit Price</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="edit-unit-price" name="unit_price" value="<?= htmlspecialchars($product['unit_price']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit-cost-price">Cost Price</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="edit-cost-price" name="cost_price" value="<?= htmlspecialchars($product['cost_price']) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="edit-description">Description (Optional)</label>
                <textarea class="form-control" id="edit-description" name="description" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="/product_list" class="btn btn-secondary">Discard</a>
            </div>
        </form>
    </div>
</div>