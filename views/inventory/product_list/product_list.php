<div class="container mt-4">
    <div class="row text-center">
        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-store fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-up fa-lg"></i></div>
                </div>
                <h5 class="h6">In-store Sales</h5>
                <div class="value" style="font-size: 1.5rem;">$3,345.43</div>
                <div class="orders" style="font-size: 0.9rem;">50 orders <span class="increase">+57%</span></div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-shopping-cart fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-up fa-lg"></i></div>
                </div>
                <h5 class="h6">Website Sales</h5>
                <div class="value" style="font-size: 1.5rem;">$674,341.12</div>
                <div class="orders" style="font-size: 0.9rem;">21 orders <span class="increase">+12%</span></div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-percent fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-down fa-lg"></i></div>
                </div>
                <h5 class="h6">Discount</h5>
                <div class="value" style="font-size: 1.5rem;">$14,263.12</div>
                <div class="orders" style="font-size: 0.9rem;">60 orders <span class="decrease">-3%</span></div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-user-friends fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-down fa-lg"></i></div>
                </div>
                <h5 class="h6">Affiliate</h5>
                <div class="value" style="font-size: 1.5rem;">$8,345.23</div>
                <div class="orders" style="font-size: 0.9rem;">150 orders <span class="decrease">-5%</span></div>
            </div>
        </div>
    </div>

    <h1>Product List</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        <h5 class="mb-4 text-primary">Filter</h5>
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                    <option>Scheduled</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Category</option>
                    <option>Electronics</option>
                    <option>Household</option>
                    <option>Shoes</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Stock</option>
                    <option>In Stock</option>
                    <option>Out of Stock</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 pt-4 pb-4 border-top border-bottom border-light py-2">
            <input type="text" class="form-control w-25" placeholder="Search Product" style="border-radius: 10px;">
            <div class="d-flex align-items-center">
                <select class="form-select w-auto me-3" style="border-radius: 10px;">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
                <button class="btn btn-outline-secondary me-3" disabled>Export</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">+ Add Product</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Barcode</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $index => $product): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['barcode'] ?></td>
                            <td><?= $product['brand'] ?></td>
                            <td><?= $product['model'] ?></td>
                            <td><?= $product['type'] ?></td>
                            <td><?= $product['status'] ?></td>
                            <td><?= $product['stock_quantity'] ?></td>
                            <td><?= !empty($product['category_name']) ? $product['category_name'] : 'No category' ?></td>
                            <td>
                                <!-- Edit Button with Correct Data Attributes -->
                                <a class="text-warning me-2 editProductBtn"
                                    data-id="<?= $product['product_id'] ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>"
                                    data-barcode="<?= htmlspecialchars($product['barcode']) ?>"
                                    data-brand="<?= htmlspecialchars($product['brand']) ?>"
                                    data-model="<?= htmlspecialchars($product['model']) ?>"
                                    data-type="<?= htmlspecialchars($product['type']) ?>"
                                    data-status="<?= htmlspecialchars($product['status']) ?>"
                                    data-stock-quantity="<?= htmlspecialchars($product['stock_quantity']) ?>"
                                    data-category="<?= htmlspecialchars($product['category_id']) ?>"
                                    data-description="<?= htmlspecialchars($product['description']) ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editProductModal">
                                    <i class="bi bi-pencil-square fs-4"></i>
                                </a>
                                <a type="button" class="text-danger deleteProductBtn"
                                    data-id="<?= $product['product_id'] ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>"
                                    data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                    <i class="bi bi-trash fs-4"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entryInfo">
                Showing <span id="startEntry">1</span> to <span id="endEntry">3</span> of <span id="totalEntries">3</span> entries
            </div>
            <nav>
                <ul class="pagination" id="pagination">
                    <li class="page-item disabled" id="prevPage">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active" id="page1">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item" id="nextPage">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<!-- Modal for Adding Product -->
<form action="/inventory/product_list/store" method="POST">
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="barcode">Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Enter product barcode" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter product brand" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" placeholder="Enter product model" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Enter product type" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="new">New</option>
                            <option value="first-hand">First Hand</option>
                            <option value="second-hand">Second Hand</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock_quantity">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter stock quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Unit Price</label>
                        <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" placeholder="Enter unit price" required>
                    </div>
                    <div class="form-group">
                        <label for="cost_price">Cost Price</label>
                        <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" placeholder="Enter cost price" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-control" required>
    <option value="">Select a Category</option>
    <?php foreach ($categories as $category): ?>
        <option value="<?= htmlspecialchars($category['category_id']) ?>">
            <?= htmlspecialchars($category['name']) ?>
        </option>
    <?php endforeach; ?>
</select>


                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Product Description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                </div>
            </div>
        </div>
    </div>
</form>



<!-- Modal for Editing Product -->
<form action="/inventory/product_list/update" method="POST">
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="edit-name">Product Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-barcode">Barcode</label>
                        <input type="text" class="form-control" id="edit-barcode" name="barcode" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-brand">Brand</label>
                        <input type="text" class="form-control" id="edit-brand" name="brand" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-model">Model</label>
                        <input type="text" class="form-control" id="edit-model" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-type">Type</label>
                        <input type="text" class="form-control" id="edit-type" name="type" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-status">Status</label>
                        <select class="form-control" id="edit-status" name="status">
                            <option value="">Select Status</option>
                            <option value="new">New</option>
                            <option value="first-hand">First Hand</option>
                            <option value="second-hand">Second Hand</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-stock-quantity">Stock Quantity</label>
                        <input type="number" class="form-control" id="edit-stock-quantity" name="stock_quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-category">Category</label>
                        <select class="form-control" id="edit-category" name="category_id" required>
                            <option value="">Select a Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-description">Description</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.querySelectorAll('.editProductBtn').forEach(button => {
    button.addEventListener('click', function() {
        // Get data attributes from the button
        const productId = this.getAttribute('data-id');
        
        // Set the values in the modal form fields
        document.getElementById('edit-name').value = this.getAttribute('data-name');
        document.getElementById('edit-barcode').value = this.getAttribute('data-barcode');
        document.getElementById('edit-brand').value = this.getAttribute('data-brand');
        document.getElementById('edit-model').value = this.getAttribute('data-model');
        document.getElementById('edit-type').value = this.getAttribute('data-type');
        document.getElementById('edit-status').value = this.getAttribute('data-status');
        document.getElementById('edit-stock-quantity').value = this.getAttribute('data-stock-quantity');
        document.getElementById('edit-category').value = this.getAttribute('data-category');
        document.getElementById('edit-description').value = this.getAttribute('data-description');

        // Set the hidden product_id field value
        document.getElementById('product_id').value = productId;

        // Update the form action dynamically with the product ID
        const form = document.querySelector('form[action^="/inventory/product_list/update"]');
        form.action = `/inventory/product_list/update/${productId}`;
    });
});

</script>



<!-- Delete Modal (Single Modal for All Product) -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteProductName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteProductForm" method="POST" action="/inventory/product_list/destroy/<?= $product['product_id'] ?>">
                    <input type="hidden" name="product_id" id="deleteProductId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".deleteProductBtn").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-id");
            document.getElementById("deleteProductId").value = productId;
        });
    });
</script>