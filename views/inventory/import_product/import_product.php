<div class="container mt-4">
    <h1>Import Products</h1>
    <form id="importProductForm" action="/your-endpoint" method="POST" enctype="multipart/form-data"> <!-- Update the action to your endpoint -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-8">
                <!-- Product Information Section -->
                <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                    <h5 class="mb-3">Product Information</h5>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Product title" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku" placeholder="e.g. SKU-123456" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="barcode" class="form-label">Barcode</label>
                            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="e.g. 0123-4567" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Product Description"></textarea>
                    </div>
                </div>

                <!-- Product Image Section -->
                <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                    <h5 class="mb-3">Product Image</h5>
                    <div class="drag-area mb-3 p-4 border rounded bg-light text-center">
                        <p>Drag and drop your image here</p>
                        <p>or</p>
                        <label for="imageUpload" class="btn btn-outline-primary">Browse image</label>
                        <input type="file" class="form-control" id="imageUpload" name="imageUpload" style="display: none;" required>
                    </div>
                    <a href="#" class="text-primary">Add media from URL</a>
                </div>

                <!-- Variants Section -->
                <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                    <h5 class="mb-3">Variants</h5>
                    <div class="mb-3">
                        <label for="variantOptions" class="form-label">Options</label>
                        <select class="form-select" id="variantOptions" name="variantOptions">
                            <option selected>Size</option>
                            <option>Color</option>
                            <option>Material</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="variantSize" class="form-label">Enter size</label>
                        <input type="text" class="form-control" id="variantSize" name="variantSize" placeholder="e.g. Small, Medium, Large">
                    </div>
                    <button class="btn btn-primary">+ Add another option</button>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <!-- Pricing Section -->
                <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                    <h5 class="mb-3">Pricing</h5>
                    <div class="mb-3">
                        <label for="basePrice" class="form-label">Base Price</label>
                        <input type="text" class="form-control" id="basePrice" name="basePrice" placeholder="Price" required>
                    </div>
                    <div class="mb-3">
                        <label for="discountedPrice" class="form-label">Discounted Price</label>
                        <input type="text" class="form-control" id="discountedPrice" name="discountedPrice" placeholder="Discounted Price">
                    </div>
                </div>

                <!-- Organization Section -->
                <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                    <h5 class="mb-3">Organize</h5>
                    <div class="mb-3">
                        <label for="vendor" class="form-label">Vendor</label>
                        <select class="form-select" id="vendor" name="vendor">
                            <option selected>Select Vendor</option>
                            <option>Vendor A</option>
                            <option>Vendor B</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="collection" class="form-label">Category</label>
                        <div class="input-group">
                            <select class="form-select" id="collection" name="collection">
                                <option selected>Select Category</option>
                                <option value="collection1">Collection 1</option>
                                <option value="collection2">Collection 2</option>
                                <option value="collection3">Collection 3</option>
                            </select>
                            <button class="btn btn-outline-primary ms-2" type="button">+</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Collection</label>
                        <select class="form-select" id="category" name="category">
                            <option selected>Select Collection</option>
                            <option>Category A</option>
                            <option>Category B</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option selected>Published</option>
                            <option>Draft</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control me-2" id="tags" name="tags" placeholder="Normal, Standard, Premium">
                            <button class="btn btn-outline-secondary" type="button">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit Product</button> <!-- Submit button -->
    </form>
</div>