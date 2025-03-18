<!-- Card for Editing Order -->
<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Edit Product</h3>
        <form action="/product_list/update/<?= $product['product_id'] ?>" method="post">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit-name">Product Name</label>
                    <input type="text" class="form-control" id="edit-name" name="name" value="<?= $product['name'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit-barcode">Barcode</label>
                    <input type="text" class="form-control" id="edit-barcode" name="barcode" value="<?= $product['barcode'] ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit-brand">Brand</label>
                    <input type="text" class="form-control" id="edit-brand" name="brand" value="<?= $product['brand'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit-model">Model</label>
                    <input type="text" class="form-control" id="edit-model" name="model" value="<?= $product['model'] ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit-type">Type</label>
                    <input type="text" class="form-control" id="edit-type" name="type" value="<?= $product['type'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit-status">Status</label>
                    <select class="form-control" id="edit-status" name="status">
                        <option value="">Select Status</option>
                        <option value="new" <?= $product['status'] == 'new' ? 'selected' : '' ?>>New</option>
                        <option value="first-hand" <?= $product['status'] == 'first-hand' ? 'selected' : '' ?>>First Hand</option>
                        <option value="second-hand" <?= $product['status'] == 'second-hand' ? 'selected' : '' ?>>Second Hand</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="edit-stock-quantity">Stock Quantity</label>
                <input type="number" class="form-control" id="edit-stock-quantity" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" required>
            </div>

            <div class="form-group">
                <label for="edit-category">Category</label>
                <select class="form-control" id="edit-category" name="category_id" required>
                    <option value="">Select a Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['category_id'] ?>" <?= $category['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                            <?= $category['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="edit-description">Description</label>
                <textarea class="form-control" id="edit-description" name="description" rows="3"><?= $product['description'] ?></textarea>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
            </div>
        </form>
    </div>
</div>
