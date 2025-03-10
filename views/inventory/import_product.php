<div class="container mt-4">

    <div class="row">
        <!-- Left Column -->
        <div class="col-md-8">
            <!-- Product Information Section -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Product Information</h5>
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Title</label>
                    <input type="text" class="form-control" id="productName" placeholder="Product title">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" placeholder="e.g. SKU-123456">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="barcode" class="form-label">Barcode</label>
                        <input type="text" class="form-control" id="barcode" placeholder="e.g. 0123-4567">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" id="description" rows="3" placeholder="Product Description"></textarea>
                </div>
            </div>

            <!-- Product Image Section -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Product Image</h5>
                <div class="drag-area mb-3 p-4 border rounded bg-light text-center">
                    <p>Drag and drop your image here</p>
                    <p>or</p>
                    <label for="imageUpload" class="btn btn-outline-primary">Browse image</label>
                    <input type="file" class="form-control" id="imageUpload" style="display: none;">
                </div>
                <a href="#" class="text-primary">Add media from URL</a>
            </div>

            <!-- Variants Section -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Variants</h5>
                <div class="mb-3">
                    <label for="variantOptions" class="form-label">Options</label>
                    <select class="form-select" id="variantOptions">
                        <option selected>Size</option>
                        <option>Color</option>
                        <option>Material</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="variantSize" class="form-label">Enter size</label>
                    <input type="text" class="form-control" id="variantSize" placeholder="e.g. Small, Medium, Large">
                </div>
                <button class="btn btn-primary">+ Add another option</button>
            </div>

            <!-- Inventory Section -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Inventory</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inventory" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="inventory" placeholder="e.g. 100">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="delivery" class="form-label">Delivery Options</label>
                        <select class="form-select" id="delivery">
                            <option selected>Standard Delivery</option>
                            <option>Express Delivery</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-4">
            <!-- Pricing Section -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Pricing</h5>
                
                <div class="mb-3">
                    <label for="basePrice" class="form-label">Base Price</label>
                    <input type="text" class="form-control" id="basePrice" placeholder="Price">
                </div>
                
                <div class="mb-3">
                    <label for="discountedPrice" class="form-label">Discounted Price</label>
                    <input type="text" class="form-control" id="discountedPrice" placeholder="Discounted Price">
                </div>
                
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="chargeTax">
                    <label class="form-check-label" for="chargeTax">Charge tax on this product</label>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">In stock</label>
                    <input type="checkbox" class="form-check-input" id="inStock" checked>
                </div>
            </div>

            <!-- Organization Section -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Organize</h5>
                
                <div class="mb-3">
                    <label for="vendor" class="form-label">Vendor</label>
                    <select class="form-select" id="vendor">
                        <option selected>Select Vendor</option>
                        <option>Vendor A</option>
                        <option>Vendor B</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category">
                        <option selected>Select Category</option>
                        <option>Category A</option>
                        <option>Category B</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="collection" class="form-label">Collection</label>
                    <input type="text" class="form-control" id="collection" placeholder="Collection">
                    <button class="btn btn-outline-primary mt-2">+</button>
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status">
                        <option selected>Published</option>
                        <option>Draft</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" placeholder="Normal, Standard, Premium">
                </div>
            </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button class="btn btn-primary btn-lg">Publish Product</button>
    </div>
</div>

