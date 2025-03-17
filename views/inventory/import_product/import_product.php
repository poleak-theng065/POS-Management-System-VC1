<div class="container mt-4">
    <h1>Import Products</h1>
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
            <!-- <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Product Image</h5>
                <div class="drag-area mb-3 p-4 border rounded bg-light text-center">
                    <p>Drag and drop your image here</p>
                    <p>or</p>
                    <label for="imageUpload" class="btn btn-outline-primary">Browse image</label>
                    <input type="file" class="form-control" id="imageUpload" accept="image/*" style="display: none;">
                </div>
                <img id="previewImage" src="" alt="Image Preview" class="img-fluid mt-3 d-none" style="max-width: 200px; border-radius: 8px;">
            </div>

            <script>
                document.getElementById("imageUpload").addEventListener("change", function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById("previewImage");
                            preview.src = e.target.result;
                            preview.classList.remove("d-none"); // Show image
                        };
                        reader.readAsDataURL(file);
                    }
                });
            </script> -->

            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Product Image</h5>
                <div class="drag-area mb-3 p-4 border rounded bg-light text-center">
                    <p>Drag and drop your image here</p>
                    <p>or</p>
                    <label for="imageUpload" class="btn btn-outline-primary">Browse image</label>
                    <input type="file" class="form-control" id="imageUpload" accept="image/*" style="display: none;">
                </div>
                <img id="previewImage" src="" alt="Image Preview" class="img-fluid mt-3 d-none" style="max-width: 200px; border-radius: 8px;">
            </div>

            <script>
                document.getElementById("imageUpload").addEventListener("change", function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById("previewImage");
                            preview.src = e.target.result;
                            preview.classList.remove("d-none"); // Show image
                        };
                        reader.readAsDataURL(file);

                        // Upload image to the server
                        const formData = new FormData();
                        formData.append("image", file);

                        fetch("upload.php", {
                                method: "POST",
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log("Image stored at:", data.filepath);
                                } else {
                                    console.error("Error storing image:", data.error);
                                }
                            })
                            .catch(error => console.error("Error uploading file:", error));
                    }
                });
            </script>

            <!-- PHP Script (upload.php) -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    echo json_encode(["success" => true, "filepath" => $targetFile]);
                } else {
                    echo json_encode(["success" => false, "error" => "Error uploading image."]);
                }
            } else {
                echo json_encode(["success" => false, "error" => "No image received."]);
            }
            ?>

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

                <button class="btn btn-primary mb-3">Restock</button>

                <div class="mb-3">
                    <label for="inventory" class="form-label">Add to Stock</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="inventory" placeholder="e.g. 100">
                        <button class="btn btn-outline-primary" type="button">Confirm</button>
                    </div>
                </div>

                <p class="mb-0">Product in stock now: <strong>54</strong></p>
                <p class="mb-0">Product in transit: <strong>390</strong></p>
                <p class="mb-0">Last time restocked: <strong>24th June, 2023</strong></p>
                <p class="mb-0">Total stock over lifetime: <strong>2430</strong></p>
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
                    <label for="inStock" class="form-label">In stock</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="inStock" checked>
                    </div>
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
                    <label for="collection" class="form-label">Category</label>
                    <div class="input-group">
                        <select class="form-select" id="collection">
                            <option selected>Select Category</option>
                            <option value="collection1">Collection 1</option>
                            <option value="collection2">Collection 2</option>
                            <option value="collection3">Collection 3</option>
                        </select>
                        <button class="btn btn-outline-primary ms-2" type="button">+</button> <!-- Added margin start -->
                    </div>
                </div>



                <div class="mb-3">
                    <label for="category" class="form-label">Collection</label>
                    <select class="form-select" id="category">
                        <option selected>Select Collection</option>
                        <option>Category A</option>
                        <option>Category B</option>
                    </select>
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
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control me-2" id="tags" placeholder="Normal, Standard, Premium">
                        <button class="btn btn-outline-secondary" type="button">Add</button>
                    </div>
                </div>
            </div>

        </div>