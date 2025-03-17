<div class="container mt-4">
    <form action="/product_list/store" method="POST">
        <div class="row">
            <!-- Product Information Section -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Products Information</h5>
                <div class="mb-3">
                    <label for="productName" class="form-label">Categories Name</label>
                    <input type="text" class="form-control" id="productName" placeholder="Categories Name">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sku" class="form-label">Model</label>
                        <input type="text" class="form-control" id="sku" placeholder="Enter Model">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="barcode" class="form-label">Type</label>
                        <input type="text" class="form-control" id="barcode" placeholder="Enter Type">
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
            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </div>
        </div>

    </form>
    
</div>