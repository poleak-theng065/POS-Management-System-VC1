

<div class="container mt-4">
    <!-- <div class="title-wrapper">
        <i class="fas fa-box-open title-icon"></i>
        <h1 class="product-list-title">Product List</h1>
    </div> -->
    <div class="row text-center">
        <?php
        // Define stock thresholds
        $lowStockThreshold = 5; // Change this if needed

        // Filter products based on stock quantity
        $runOutOfStock = array_filter($products, function($product) {
            return $product['stock_quantity'] == 0;
        });

        $lowStockProducts = array_filter($products, function($product) use ($lowStockThreshold) {
            return $product['stock_quantity'] > 0 && $product['stock_quantity'] <= $lowStockThreshold;
        });

        // Count total for dashboard
        $totalRunOutOfStock = count($runOutOfStock);
        $totalLowStock = count($lowStockProducts);
        ?>

        <style>
            .view-icon {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 1.2rem;
                color: #6c757d; /* Muted color */
                cursor: pointer;
                transition: color 0.3s ease-in-out;
            }

            .view-icon:hover {
                color: #007bff; /* Change to blue on hover */
            }

            .card-container {
                position: relative; /* Ensure the icon stays in the top-right */
            }
        </style>

        <!-- Run Out Of Stock -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-exclamation-triangle text-danger fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Run Out Of Stock</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;"><?= $totalRunOutOfStock ?> Products</div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">Restock Needed Urgently</div>
                </a>
                <a href="/run_out_of_stock" class="view-icon" data-bs-toggle="tooltip" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-arrow-down text-warning fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Low Stock Products</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;"><?= $totalLowStock ?> Products</div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">Stock Level Below <?= $lowStockThreshold ?> Units</div>
                </a>
                <a href="/low_stock_product" class="view-icon" data-bs-toggle="tooltip" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Total Models -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-layer-group text-primary fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Total Models</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">42 Models</div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">Includes All Available Phones</div>
                </a>
                <a href="/model_list" class="view-icon" data-bs-toggle="tooltip" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <?php
        
        // Instantiate the CategoryModel class
        $categoryModel = new CategoryModel();

        // Retrieve categories count from the database
        $categories = $categoryModel->getCategories(); // This fetches all categories

        // Count the number of unique categories
        $totalCategories = count($categories);
        ?>

        <!-- Total Categories Card -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container">
                <div class="d-flex justify-content-between">
                    <div class="icon-right"><i class="fas fa-list-alt text-info fa-lg"></i></div>
                </div>
                <h5 class="h6 text-dark">Total Categories</h5>
                <div class="value text-dark" style="font-size: 1.5rem;">
                    <?= $totalCategories . " Categories" ?>
                </div>
                <div class="orders text-dark" style="font-size: 0.9rem;">Includes Accessories & Phones</div>
                <a href="/category_list" class="view-icon" data-bs-toggle="tooltip" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <script>
            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        </script>

    </div>


    <div class="row g-4 mb-5">
    <div class="col-md-4">
        <select class="form-select">
            <option selected>Status</option>
            <option>New</option>
            <option>First-Hand</option>
            <option>Second-Hand</option>
        </select>
    </div>
    <div class="col-md-4">
        <select class="form-select" id="categorySelect">
            <option selected>Category</option>
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

<div class="table-responsive">
    <!-- Your existing table HTML remains unchanged -->
</div>

<script>
    function populateCategories() {
        const categorySelect = document.getElementById('categorySelect');
        categorySelect.innerHTML = '<option selected>Category</option>';
        
        // Get all unique categories from the table
        const categoryCells = document.querySelectorAll('#switchTableBody tr td:nth-child(7)');
        const categories = new Set();
        
        categoryCells.forEach(cell => {
            const category = cell.textContent.trim();
            if (category !== 'No category') {
                categories.add(category);
            }
        });
        
        // Populate dropdown
        Array.from(categories).sort().forEach(category => {
            const option = document.createElement('option');
            option.value = category.toLowerCase();
            option.textContent = category;
            categorySelect.appendChild(option);
        });
    }

    function filterProducts() {
        const statusFilterElement = document.querySelector('.row.g-4.mb-5 .col-md-4:nth-child(1) .form-select');
        const categoryFilterElement = document.getElementById('categorySelect');
        const stockFilterElement = document.querySelector('.row.g-4.mb-5 .col-md-4:nth-child(3) .form-select');

        const statusFilter = statusFilterElement.value.trim().toLowerCase();
        const categoryFilter = categoryFilterElement.value.trim().toLowerCase();
        const stockFilter = stockFilterElement.value.trim().toLowerCase();

        const rows = document.querySelectorAll('#switchTableBody tr');
        let visibleRows = 0;

        rows.forEach((row) => {
            const status = row.cells[4].textContent.trim().toLowerCase();      // Status column
            const quantity = parseInt(row.cells[5].textContent.trim());        // Quantity column
            const category = row.cells[6].textContent.trim().toLowerCase();    // Category column
            const stockStatus = quantity > 0 ? 'in stock' : 'out of stock';

            const matchesStatus = (statusFilter === 'status' || status === statusFilter);
            const matchesCategory = (categoryFilter === 'category' || category === categoryFilter || (categoryFilter === 'no category' && category === 'no category'));
            const matchesStock = (stockFilter === 'stock' || stockStatus === stockFilter);

            if (matchesStatus && matchesCategory && matchesStock) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('entriesInfo').textContent = `Showing 1 to ${visibleRows} of ${rows.length} entries`;
    }

    // Initialize everything
    document.addEventListener('DOMContentLoaded', () => {
        populateCategories();
        
        document.querySelectorAll('.form-select').forEach(select => {
            select.addEventListener('change', filterProducts);
        });
        
        filterProducts();
    });
</script>

        <div class="d-flex justify-content-between align-items-center mb-4 pt-4 pb-4 border-top border-bottom border-light py-2">
            <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
            <div class="d-flex align-items-center">
                <!-- <select class="form-select w-auto me-3" style="border-radius: 10px;">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select> -->
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
                        <tr class="<?= $product['stock_quantity'] == 0 ? 'bg-danger-light' : ($product['stock_quantity'] <= 5 ? 'bg-warning-light' : '') ?>">
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

<style>
    .bg-danger-light {
        background-color: #f8d7da !important; /* Lighter red */
    }

    .bg-warning-light {
        background-color: #fff3cd !important; /* Lighter yellow */
    }
</style>

<!-- Delete Modal (Single Modal for All Product) -->
<script>
    document.querySelectorAll(".deleteProductBtn").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-id");
            document.getElementById("deleteProductId").value = productId;
        });
    });
</script>

<!-- Alert Create product -->
<div id="formAlertContainer" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050; width: 300px;"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const status = localStorage.getItem('productStatus');

        console.log("Retrieved productStatus:", status); // Debugging log

        if (status) {
            let alertHTML = '';
            let alertType = '';
            let alertMessage = '';

            if (status === 'success') {
                alertType = 'success';
                alertMessage = '<strong>Success!</strong> Product added successfully.';
            } else if (status === 'duplicate') {
                alertType = 'warning';
                alertMessage = '<strong>Warning!</strong> Product already exists.';
            } else if (status === 'fail') {
                alertType = 'danger';
                alertMessage = '<strong>Error!</strong> Could not add product.';
            } else {
                console.log("Unexpected status value:", status); // Log unexpected values
            }

            if (alertMessage) {
                alertHTML = `<div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${alertMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="progress mt-2">
                                <div id="progressBar" class="progress-bar bg-${alertType}" style="width: 100%; transition: width 0.1s linear;"></div>
                            </div>
                        </div>`;

                document.getElementById('formAlertContainer').innerHTML = alertHTML;

                // Start progress bar countdown
                let duration = 5;
                let current = duration;
                const progressBar = document.getElementById('progressBar');
                const interval = setInterval(() => {
                    current -= 0.1;
                    let percent = (current / duration) * 100;
                    progressBar.style.width = percent + '%';
                    if (current <= 0) {
                        clearInterval(interval);
                        progressBar.closest('.alert').remove();
                    }
                }, 100);

                // Remove status from localStorage after displaying
                localStorage.removeItem('productStatus');
            }
        }
    });
</script>

<!-- Alert Update product -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const status = localStorage.getItem('productUpdateStatus');

        console.log("Retrieved productUpdateStatus:", status); // Debugging log

        if (status) {
            let alertHTML = '';
            let alertType = '';
            let alertMessage = '';

            if (status === 'success') {
                alertType = 'success';
                alertMessage = '<strong>Success!</strong> Product updated successfully.';
            } else if (status === 'duplicate') {
                alertType = 'warning';
                alertMessage = '<strong>Warning!</strong> Product already exists.';
            } else if (status === 'fail') {
                alertType = 'danger';
                alertMessage = '<strong>Error!</strong> Could not update product.';
            } else {
                console.log("Unexpected status value:", status); // Log unexpected values
            }

            if (alertMessage) {
                alertHTML = `<div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${alertMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="progress mt-2">
                                <div id="progressBar" class="progress-bar bg-${alertType}" style="width: 100%; transition: width 0.1s linear;"></div>
                            </div>
                        </div>`;

                document.getElementById('formAlertContainer').innerHTML = alertHTML;

                // Start progress bar countdown
                let duration = 5;
                let current = duration;
                const progressBar = document.getElementById('progressBar');
                const interval = setInterval(() => {
                    current -= 0.1;
                    let percent = (current / duration) * 100;
                    progressBar.style.width = percent + '%';
                    if (current <= 0) {
                        clearInterval(interval);
                        progressBar.closest('.alert').remove();
                    }
                }, 100);

                // Remove status from localStorage after displaying
                localStorage.removeItem('productUpdateStatus');
            }
        }
    });
</script>

<!-- Alert Delete product -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const status = localStorage.getItem('productDeleteStatus');

        console.log("Retrieved productDeleteStatus:", status); // Debugging log

        if (status) {
            let alertHTML = '';
            let alertType = '';
            let alertMessage = '';

            if (status === 'success') {
                alertType = 'success';
                alertMessage = '<strong>Success!</strong> Product deleted successfully.';
            } else if (status === 'duplicate') {
                alertType = 'warning';
                alertMessage = '<strong>Warning!</strong> Product already exists.';
            } else if (status === 'fail') {
                alertType = 'danger';
                alertMessage = '<strong>Error!</strong> Could not delete product.';
            } else {
                console.log("Unexpected status value:", status); // Log unexpected values
            }

            if (alertMessage) {
                alertHTML = `<div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${alertMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="progress mt-2">
                                <div id="progressBar" class="progress-bar bg-${alertType}" style="width: 100%; transition: width 0.1s linear;"></div>
                            </div>
                        </div>`;

                document.getElementById('formAlertContainer').innerHTML = alertHTML;

                // Start progress bar countdown
                let duration = 5;
                let current = duration;
                const progressBar = document.getElementById('progressBar');
                const interval = setInterval(() => {
                    current -= 0.1;
                    let percent = (current / duration) * 100;
                    progressBar.style.width = percent + '%';
                    if (current <= 0) {
                        clearInterval(interval);
                        progressBar.closest('.alert').remove();
                    }
                }, 100);

                // Remove status from localStorage after displaying
                localStorage.removeItem('productDeleteStatus');
            }
        }
    });
</script>
