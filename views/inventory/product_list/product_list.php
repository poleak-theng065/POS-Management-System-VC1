<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>

<div class="container mt-4">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block" 
            style="border-left: 8px solid #0dcaf0; background-color: #f8f9fa;">
        <i class="bi bi-list-ul text-info me-2"></i> Product List - Available Items
    </h1>

    <div class="row text-center">
        <?php
        // Define stock thresholds
        $lowStockThreshold = 5; // Change this if needed

            // Filter products based on stock quantity
            $runOutOfStock = array_filter($products, function ($product) {
                return $product['stock_quantity'] == 0;
            });

            $lowStockProducts = array_filter($products, function ($product) use ($lowStockThreshold) {
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
                    color: #6c757d;
                    /* Muted color */
                    cursor: pointer;
                    transition: color 0.3s ease-in-out;
                }

                .view-icon:hover {
                    color: #007bff;
                    /* Change to blue on hover */
                }

                .card-container {
                    position: relative;
                    /* Ensure the icon stays in the top-right */
                }

            </style>

            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right">
                            <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                        </div>
                    </div>
                    <h5 class="h6 text-dark">Run Out Of Stock</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;"><?= $totalRunOutOfStock ?> Products</div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">Restock Needed Urgently</div>

                    <!-- View Details Button to Trigger Modal -->
                    <a href="#runOutOfStockModal" class="view-icon" data-bs-toggle="modal" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Modal for showing out of stock products -->
            <div class="modal fade" id="runOutOfStockModal" tabindex="-1" aria-labelledby="runOutOfStockModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger fw-bold fs-4" id="runOutOfStockModalLabel">
                                <i class="fas fa-exclamation-triangle me-2"></i> Out of Stock Products
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <?php if ($product['stock_quantity'] == 0): ?>
                                            <tr class="border-bottom">
                                                <td><?= htmlspecialchars($product['barcode']) ?></td>
                                                <td>
                                                    <div class="product-image-container">
                                                        <img src="<?= !empty($product['image_path']) ? 'assets/img/upload/' . $product['image_path'] : '/path/to/default/image.png' ?>" 
                                                            alt="Product Image" class="product-image">
                                                    </div>
                                                    <?= htmlspecialchars($product['name']) ?>
                                                </td>
                                                <td><span class="text-danger"><?= $product['stock_quantity'] ?></span></td>
                                                <td><?= !empty($product['category_name']) ? htmlspecialchars($product['category_name']) : 'No category' ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stock Products -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right">
                            <i class="fas fa-arrow-down text-warning fa-lg"></i>
                        </div>
                    </div>
                    <h5 class="h6 text-dark">Low Stock Products</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalLowStock ?> Products
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Stock Level Below <?= $lowStockThreshold ?> Units
                    </div>

                    <!-- View Details Button to Trigger Modal -->
                    <a href="#lowStockModal" class="view-icon" data-bs-toggle="modal" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Modal for showing low stock products -->
            <div class="modal fade" id="lowStockModal" tabindex="-1" aria-labelledby="lowStockModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning fw-bold fs-4" id="lowStockModalLabel">
                                <i class="fas fa-arrow-down me-2"></i> Low Stock Products
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <?php if ($product['stock_quantity'] <= $lowStockThreshold && $product['stock_quantity'] > 0): ?>
                                            <tr  class="border-bottom">
                                            <td><?= htmlspecialchars($product['barcode']) ?></td>
                                            <td>
                                                <div class="product-image-container">
                                                    <img src="<?= !empty($product['image_path']) ? 'assets/img/upload/' . $product['image_path'] : '/path/to/default/image.png' ?>" 
                                                        alt="Product Image" class="product-image">
                                                </div>
                                                <span><?= htmlspecialchars($product['name']) ?></span>
                                            </td>
                                            <td><span class="text-warning"><?= $product['stock_quantity'] ?></span></td>
                                            <td><?= !empty($product['category_name']) ? htmlspecialchars($product['category_name']) : 'No category' ?></td>

                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Total Brands -->
            <?php
            // Get unique brands (removes duplicates)
            $brands = array_unique(array_column($products, 'brand'));
            $totalBrands = count($brands); // Total number of unique brands
            ?>

            <!-- Total Brands Card -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right">
                            <i class="fas fa-layer-group text-primary fa-lg"></i>
                        </div>
                    </div>
                    <h5 class="h6 text-dark">Total Brands</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalBrands ?> Brands
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Unique Brands in Stock
                    </div>

                    <!-- View Details Button to Trigger Modal -->
                    <a href="#brandDetailsModal" class="view-icon" data-bs-toggle="modal" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Modal for showing brand details -->
            <div class="modal fade" id="brandDetailsModal" tabindex="-1" aria-labelledby="brandDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm"> <!-- Reduced size of the modal to "modal-sm" -->
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title text-primary fw-bold fs-4" id="brandDetailsModalLabel">
                                <i class="fas fa-layer-group text-primary me-2"></i> Product Brands
                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start" style="max-height: 300px; overflow-y: auto;">
                            <!-- Table for displaying unique brands -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>List of Brand</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($brands as $brand): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($brand) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
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
                        <div class="icon-right">
                            <i class="fas fa-list-alt text-info fa-lg"></i>
                        </div>
                    </div>
                    <h5 class="h6 text-dark">Total Categories</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalCategories ?> Categories
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
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            </script>
    </div>


        <div class="row g-4 mb-4 mt-1">
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

        <div class="card p-4 bg-white shadow-lg border-0">
            <div class="d-flex justify-content-between align-items-center mb-4 py-2">
                <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
                <div class="d-flex align-items-center">
                    <!-- <select class="form-select w-auto me-3" style="border-radius: 10px;">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select> -->
                    <div class="btn-group me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark-arrow-down me-2"></i> Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportButton">
                            <li>
                                <button id="exportExcel" class="dropdown-item">
                                    <i class="bi bi-file-earmark-excel me-2"></i> Export to Excel
                                </button>
                            </li>
                            <li>
                                <button id="exportPdf" class="dropdown-item">
                                    <i class="bi bi-file-earmark-pdf me-2"></i> Export to PDF
                                </button>
                            </li>
                        </ul>
                    </div>

                    <a href="/product_list/create" class="btn btn-primary ms-2">+ Add Product</a>
                </div>

            </div>

            <!-- display product list -->
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
                    <tbody id="switchTableBody">
                        <?php foreach ($products as $index => $product): ?>
                            <tr class="border-bottom search clickable-row" data-product-id="<?= $product['product_id'] ?>"
                                data-barcode="<?= $product['barcode'] ?>"
                                data-image="<?= !empty($product['image_path']) ? 'assets/img/upload/' . $product['image_path'] : '/path/to/default/image.png' ?>"
                                data-name="<?= $product['name'] ?>"
                                data-brand="<?= $product['brand'] ?>"
                                data-type="<?= $product['type'] ?>"
                                data-status="<?= $product['status'] ?>"
                                data-stock="<?= $product['stock_quantity'] ?>"
                                data-category="<?= !empty($product['category_name']) ? $product['category_name'] : 'No category' ?>">

                                <td><?= $product['barcode'] ?></td>

                                <!-- Combined image and name in one column -->
                                <td>
                                    <div class="product-image-container">
                                        <img src="<?= !empty($product['image_path']) ? 'assets/img/upload/' . $product['image_path'] : '/path/to/default/image.png' ?>"
                                            alt="Product Image" class="product-image">
                                    </div>

                                    <?php if ($product['stock_quantity'] == 0): ?>
                                        <i class="bi bi-x-circle-fill text-danger" style="margin-right: 3px;"></i> 
                                    <?php elseif ($product['stock_quantity'] <= 5): ?>
                                        <i class="bi bi-exclamation-circle-fill text-warning" style="margin-right: 3px;"></i> 
                                    <?php endif; ?>

                                    <?= htmlspecialchars($product['name']) ?>
                                </td>
                                <td><?= $product['brand'] ?></td>
                                <td><?= $product['type'] ?></td>
                                <td><?= $product['status'] ?></td>
                                <td class="<?php
                                            if ($product['stock_quantity'] == 0) {
                                                echo 'text-danger'; // Out of stock
                                            } elseif ($product['stock_quantity'] <= 5) {
                                                echo 'text-warning'; // Low stock
                                            }
                                            ?>">
                                    <?= $product['stock_quantity'] ?>
                                </td>
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
            <!-- Pagination Component -->
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
                        <li class="page-item active" aria-current="page" id="page1">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item" id="page2">
                            <a class="page-link" href="#">2</a>
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


<!-- style for image in each row -->
<style>
    .product-image-container {
    background-color: #f0f0f0;  
    border-radius: 8px;       
    padding: 2px;             
    display: inline-block;      
    }

    .product-image {
        width: 40px;               
        height: 40px;              
        /* border-radius: 8px;  Rounded corners of the image */
    }

    .table td {
        vertical-align: middle; 
        text-align: left;       
    }

    .table td:nth-child(2) {
        display: flex;          
        align-items: center;    
        justify-content: flex-start;
        border:none;
        font-weight: normal; 
    }


    .product-image-container {
        margin-right: 10px;    
    }
</style>



<!-- Bootstrap Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white fw-bold" id="productDetailsLabel">Product Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="row g-4">
                    
                    <!-- Left: Image Section -->
                    <div class="col-md-5">
                        <div id="modal-image-container" class="text-center">
                            <!-- Image will be appended here -->
                        </div>
                    </div>


                    <!-- Right: Product Details -->
                    <div class="col-md-7 d-flex flex-column">
                        <div class="border-0 shadow-sm p-3 flex-fill">
                            <h4 class="text-primary fw-bold mb-3" id="modal-name"></h4>
                            <p class="mb-2"><strong>Stock:</strong> <span id="modal-stock"></span></p>
                            <p class="mb-2"><strong>Status:</strong> <span id="modal-status"></span></p>
                            <p class="mb-2"><strong>Category:</strong> <span id="modal-category"></span></p>
                            <p class="mb-2"><strong>Barcode:</strong> <span id="modal-barcode"></span></p>
                            <p class="mb-2"><strong>Brand:</strong> <span id="modal-brand"></span></p>
                            <p class="mb-2"><strong>Type:</strong> <span id="modal-type"></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    #modal-image-container {
    display: flex;               
    justify-content: center;     
    align-items: center;       
    height: 100%;                
    }

    #modal-image-container img {
        max-width: 100%;            
        height: auto;              
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.clickable-row').forEach(function(row) {
        row.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                // Get product details from the data attributes
                const barcode = row.getAttribute('data-barcode');
                const name = row.getAttribute('data-name');
                const brand = row.getAttribute('data-brand');
                const type = row.getAttribute('data-type');
                const status = row.getAttribute('data-status');
                const stock = row.getAttribute('data-stock');
                const category = row.getAttribute('data-category');
                const image = row.getAttribute('data-image');

                // Set modal data
                document.getElementById('modal-barcode').textContent = barcode;
                document.getElementById('modal-name').textContent = name;
                document.getElementById('modal-brand').textContent = brand;
                document.getElementById('modal-type').textContent = type;
                document.getElementById('modal-status').textContent = status;
                document.getElementById('modal-stock').textContent = stock;
                document.getElementById('modal-category').textContent = category;

                // Set the product image
                const modalImageContainer = document.getElementById('modal-image-container');
                modalImageContainer.innerHTML = ""; // Clear previous image

                if (image) { // Check if image exists
                    const modalImage = document.createElement('img');
                    modalImage.src = image;
                    modalImage.alt = name;
                    modalImage.classList.add('modal-image'); // Add a CSS class for styling
                    modalImageContainer.appendChild(modalImage);
                }

                // Show the modal
                new bootstrap.Modal(document.getElementById('productDetailsModal')).show();
            }
        });
    });
});

</script>
<style>
    .modal-image {
    width: 100%; /* Make sure the image fits the card */
    height: 220px; /* Fixed height for uniformity */
    object-fit: cover; /* Ensures images are cropped properly without distortion */
    border-radius: 8px; /* Smooth rounded corners */
    display: block;
    margin: 0 auto; /* Center the image */
}

</style>


    <!-- Display cursor pointer in each column -->
    <style>
        /* Add cursor pointer to clickable rows */
        .clickable-row {
            cursor: pointer;
        }

        /* Optional: Add a hover effect */
        .clickable-row:hover {
            background-color: #f1f1f1;
        }
    </style>


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
            background-color: #f8d7da !important;
            /* Lighter red */
        }

        .bg-warning-light {
            background-color: #fff3cd !important;
            /* Lighter yellow */
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

    <script>
        function populateCategories() {
            const categorySelect = document.getElementById('categorySelect');
            categorySelect.innerHTML = '<option selected>Category</option>';

            const categoryCells = document.querySelectorAll('#switchTableBody tr td:nth-child(7)');
            let categories = [];

            categoryCells.forEach(cell => {
                const category = cell.textContent.trim();
                if (category !== 'No category' && !categories.includes(category)) {
                    categories.push(category);
                }
            });

            categories.sort().forEach(category => {
                const option = document.createElement('option');
                option.value = category.toLowerCase();
                option.textContent = category;
                categorySelect.appendChild(option);
            });
        }

        function filterProducts() {
            const statusFilterElement = document.querySelector('.row.g-4.mb-4 .col-md-4:nth-child(1) .form-select');
            const categoryFilterElement = document.getElementById('categorySelect');
            const stockFilterElement = document.querySelector('.row.g-4.mb-4 .col-md-4:nth-child(3) .form-select');

            const statusFilter = statusFilterElement.value.trim().toLowerCase();
            const categoryFilter = categoryFilterElement.value.trim().toLowerCase();
            const stockFilter = stockFilterElement.value.trim().toLowerCase();

            const rows = document.querySelectorAll('#switchTableBody tr');
            let visibleRows = 0;

            rows.forEach(row => {
                const status = row.cells[4].textContent.trim().toLowerCase();
                const quantity = parseInt(row.cells[5].textContent.trim());
                const category = row.cells[6].textContent.trim().toLowerCase();
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

            document.getElementById('entriesInfo').textContent = `Showing ${visibleRows} of ${rows.length} entries`;
        }

        // Initialize when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            populateCategories();

            document.querySelectorAll('.form-select').forEach(select => {
                select.addEventListener('change', filterProducts);
            });

            filterProducts(); // Run filter once to sync UI
        });
    </script>


    <!-- Export excel -->
    <script>
        document.getElementById("exportExcel").addEventListener("click", function() {
            let table = document.getElementById("productTable");
            let wb = XLSX.utils.book_new();
            let wsData = [];

            // Extract headers while ignoring the "Action" column
            let headers = [];
            table.querySelectorAll("thead th").forEach((th, index, arr) => {
                if (index !== arr.length - 1) headers.push(th.innerText);
            });
            wsData.push(headers);

            // Extract rows while ignoring the "Action" column
            table.querySelectorAll("tbody tr").forEach(row => {
                let rowData = [];
                row.querySelectorAll("td").forEach((td, index, arr) => {
                    if (index !== arr.length - 1) rowData.push(td.innerText);
                });
                wsData.push(rowData);
            });

            let ws = XLSX.utils.aoa_to_sheet(wsData);

            // Auto-adjust column width
            let colWidths = headers.map(header => ({
                wch: header.length + 5
            }));
            ws['!cols'] = colWidths;

            // Define styling properties
            let headerStyle = {
                font: {
                    bold: true,
                    color: {
                        rgb: "FFFFFF"
                    }
                },
                fill: {
                    fgColor: {
                        rgb: "4F81BD"
                    }
                }, // Blue background for headers
                alignment: {
                    horizontal: "center",
                    vertical: "center"
                },
                border: {
                    top: {
                        style: "thin",
                        color: {
                            rgb: "000000"
                        }
                    },
                    bottom: {
                        style: "thin",
                        color: {
                            rgb: "000000"
                        }
                    },
                    left: {
                        style: "thin",
                        color: {
                            rgb: "000000"
                        }
                    },
                    right: {
                        style: "thin",
                        color: {
                            rgb: "000000"
                        }
                    }
                }
            };

            let rowStyle1 = {
                fill: {
                    fgColor: {
                        rgb: "F2F2F2"
                    }
                }, // Light gray background
                alignment: {
                    horizontal: "left",
                    vertical: "center"
                }
            };

            let rowStyle2 = {
                fill: {
                    fgColor: {
                        rgb: "FFFFFF"
                    }
                }, // White background
                alignment: {
                    horizontal: "left",
                    vertical: "center"
                }
            };

            // Apply styles
            const range = XLSX.utils.decode_range(ws['!ref']);
            for (let C = range.s.c; C <= range.e.c; C++) {
                let cellAddress = XLSX.utils.encode_cell({
                    r: 0,
                    c: C
                });
                if (ws[cellAddress]) ws[cellAddress].s = headerStyle;
            }

            for (let R = 1; R <= range.e.r; R++) {
                let fillStyle = R % 2 === 0 ? rowStyle1 : rowStyle2;
                for (let C = range.s.c; C <= range.e.c; C++) {
                    let cellAddress = XLSX.utils.encode_cell({
                        r: R,
                        c: C
                    });
                    if (ws[cellAddress]) ws[cellAddress].s = fillStyle;
                }
            }

            // Add worksheet to workbook
            XLSX.utils.book_append_sheet(wb, ws, "Products");

            // Export as Excel file
            XLSX.writeFile(wb, "products.xlsx");
        });
    </script>


    <!-- Export pdf -->
    <script>
        // Export PDF
        document.getElementById("exportPdf").addEventListener("click", function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            let table = document.getElementById("productTable");
            let headers = [];
            let rows = [];

            // Get headers excluding "Action"
            table.querySelectorAll("thead th").forEach((th, index, arr) => {
                if (index !== arr.length - 1) headers.push(th.innerText);
            });

            // Get rows excluding "Action" column
            table.querySelectorAll("tbody tr").forEach(row => {
                let rowData = [];
                row.querySelectorAll("td").forEach((td, index, arr) => {
                    if (index !== arr.length - 1) rowData.push(td.innerText);
                });
                rows.push(rowData);
            });

            // Add title & description
            doc.setFontSize(18);
            doc.text("Store Name", 14, 15);
            doc.setFontSize(12);
            doc.text("Order Product List", 14, 25);
            doc.setFontSize(10);
            doc.text("This document contains a list of products available in the store.", 14, 32);

            // Generate table
            doc.autoTable({
                startY: 40,
                head: [headers],
                body: rows,
                styles: {
                    fontSize: 10,
                    cellPadding: 4
                },
                headStyles: {
                    fillColor: [31, 78, 120],
                    textColor: 255,
                    fontStyle: "bold",
                    halign: "center"
                },
                alternateRowStyles: {
                    fillColor: [242, 242, 242]
                },
            });

            doc.save("products.pdf");
        });
    </script>


<?php else: ?>
    <?php $this->redirect('/login'); ?>
<?php endif; ?>