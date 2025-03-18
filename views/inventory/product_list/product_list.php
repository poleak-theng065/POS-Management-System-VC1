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
            <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
            <div class="d-flex align-items-center">
                <select class="form-select w-auto me-3" style="border-radius: 10px;">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
                <button class="btn btn-outline-secondary me-3" disabled>Export</button>
                <a href="/product_list/create" class="btn btn-primary ms-2">+ Add Product</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id='switchTableBody'>
                    <?php foreach ($products as $index => $product): ?>
                        <tr>
                            <td><?= $product['barcode'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['brand'] ?></td>
                            <td><?= $product['type'] ?></td>
                            <td><?= $product['status'] ?></td>
                            <td><?= $product['stock_quantity'] ?></td>
                            <td><?= !empty($product['category_name']) ? $product['category_name'] : 'No category' ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-0 m-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a href="/product_list/edit/<?= $product['product_id'] ?>" class="dropdown-item text-warning">
                                                <i class="bi bi-pencil-square fs-4"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a type="button" class="dropdown-item text-danger deleteProductBtn"
                                                data-id="<?= $product['product_id'] ?>"
                                                data-name="<?= htmlspecialchars($product['name']) ?>"
                                                data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                                <i class="bi bi-trash fs-4"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entriesInfo" class="text-muted">
                Showing 1 to <?= count($products) ?> of <?= count($products) ?> entries
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
                <form id="deleteProductForm" method="POST" action="/product_list/destroy/<?= $product['product_id'] ?>">
                    <input type="hidden" name="product_id" id="deleteProductId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal (Single Modal for All Product) -->
<script>
    document.querySelectorAll(".deleteProductBtn").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-id");
            document.getElementById("deleteProductId").value = productId;
        });
    });
</script>