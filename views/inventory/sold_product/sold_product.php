<?php
// Ensure Bootstrap and Font Awesome are included in your project
// This code assumes they are already included in your layout file
?>

<style>
    th.sortable {
        cursor: pointer;
    }

    th.sortable:hover span {
        visibility: visible;
    }

    th span {
        visibility: hidden;
        margin-left: 5px;
    }

    .card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .category-image {
        width: 50px;
        height: auto;
    }

    .product-image-container {
        background-color: #f0f0f0;
        border-radius: 8px;
        padding: 2px;
        display: inline-block;
        margin-right: 10px;
    }

    .product-image {
        width: 40px;
        height: 40px;
        border-radius: 5px;
        object-fit: cover;
    }

    .table {
        border-collapse: collapse;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: left;
        border-bottom: 1px solid #dee2e6 !important;
        padding: 12px;
    }

    .table th {
        border-bottom: 2px solid #dee2e6 !important;
        text-transform: uppercase;
        color: #6c757d;
        font-weight: 600;
    }

    .table td.name-column {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        border: none;
    }

    .table td.name-column > * {
        border-bottom: none;
    }

    .clickable-row {
        cursor: pointer;
    }

    .clickable-row:hover {
        background-color: #f8f9fa;
    }

    #modal-image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    #modal-image-container img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .modal-header.bg-primary {
        background-color: #6f42c1;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .modal-content {
        border-radius: 8px;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .modal-body {
        padding: 20px;
    }

    .modal-body .row {
        align-items: center;
    }

    .modal-body p {
        margin-bottom: 10px;
        font-size: 1rem;
    }

    .modal-body strong {
        color: #333;
        font-weight: 600;
    }

    .modal-body span {
        color: #555;
    }

    .modal-footer {
        border-top: none;
        padding: 15px;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 5px;
        padding: 8px 20px;
    }
</style>

<div class="container">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block"
        style="border-left: 8px solid #198754; background-color: #f8f9fa;">
        <i class="bi bi-cart-check text-success me-2"></i> Sales List - Sold Items
    </h1>
</div>

<div class="container d-flex flex-row">
    <!-- Total Profit Sold Product -->
    <div class="col-md-6 d-flex">
        <div class="card p-3 flex-grow-1 d-flex flex-column">
            <div class="d-flex align-items-start">
                <div class="icon-right me-3">
                    <i class="fas fa-credit-card text-success fa-lg"></i>
                </div>
                <h5 class="h6 text-dark">Sold Profit</h5>
            </div>
            <div class="value text-dark" style="font-size: 1.5rem;">
                $<?= number_format($totalProfit, 2) ?>
            </div>
            <div class="orders text-dark" style="font-size: 0.9rem;">
                The total profit from all sales.
            </div>
            <a href="/arrived_product" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </div>

    <!-- Total Sold Items -->
    <div class="col-md-6 d-flex">
        <div class="card p-3 flex-grow-1 d-flex flex-column">
            <div class="d-flex align-items-start">
                <div class="icon-right me-3">
                    <i class="fas fa-box-open text-danger fa-lg"></i>
                </div>
                <h5 class="h6 text-dark">Sold Product</h5>
            </div>
            <div class="value text-dark" style="font-size: 1.5rem;">
                <?= isset($totalQuantitySold) ? $totalQuantitySold : '0'; ?> Items
            </div>
            <div class="orders text-dark" style="font-size: 0.9rem;">
                Total items sold successfully.
            </div>
            <a href="/sold_product" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </div>
</div>

<!-- View sold product list -->
<div class="container mt-4">
    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($saleItems as $saleItem): ?>
                        <tr class="clickable-row"
                            data-id="<?= $saleItem['sale_item_id'] ?>"
                            data-details='<?= json_encode($saleItem, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>'>
                            <td><?= htmlspecialchars($saleItem['barcode']) ?></td>
                            <td class="name-column">
                                <div class="product-image-container">
                                    <img src="<?= !empty($saleItem['image_path']) ? '/assets/img/upload/' . htmlspecialchars($saleItem['image_path']) : '/assets/img/default.png' ?>"
                                        alt="Product Image" class="product-image">
                                </div>
                                <span><?= htmlspecialchars($saleItem['name']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($saleItem['brand']) ?></td>
                            <td><?= htmlspecialchars($saleItem['quantity']) ?></td>
                            <td><?= htmlspecialchars($saleItem['discount']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entryInfo">
                Showing <span id="startEntry">1</span> to <span id="endEntry"><?= count($saleItems) ?></span> of <span id="totalEntries"><?= count($saleItems) ?></span> entries
            </div>
            <nav>
                <ul class="pagination" id="pagination">
                    <li class="page-item disabled" id="prevPage">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li class="page-item active" id="page1">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item" id="nextPage">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

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
                            <p class="mb-2"><strong>Barcode:</strong> <span id="barcode"></span></p>
                            <p class="mb-2"><strong>Brand:</strong> <span id="brand"></span></p>
                            <p class="mb-2"><strong>Quantity:</strong> <span id="quantity"></span></p>
                            <p class="mb-2"><strong>Discount:</strong> <span id="discount"></span></p>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get all clickable rows and view buttons
    const rows = document.querySelectorAll('.clickable-row');
    const viewButtons = document.querySelectorAll('.view-details');
    const modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));

    // Function to populate and show the modal
    function showProductDetails(saleItem) {
        // Populate the modal with the sale item details
        document.getElementById('modal-name').textContent = saleItem.name || 'N/A';
        document.getElementById('barcode').textContent = saleItem.barcode || 'N/A';
        document.getElementById('brand').textContent = saleItem.brand || 'N/A';
        document.getElementById('quantity').textContent = saleItem.quantity || '0';
        document.getElementById('discount').textContent = saleItem.discount || '0.00';

        // Populate the image
        const imageContainer = document.getElementById('modal-image-container');
        imageContainer.innerHTML = ''; // Clear previous image
        const img = document.createElement('img');
        img.src = saleItem.image_path ? '/assets/img/upload/' + saleItem.image_path : '/assets/img/default.png';
        img.alt = 'Product Image';
        img.style.maxWidth = '100%';
        img.style.height = 'auto';
        img.style.borderRadius = '10px';
        imageContainer.appendChild(img);

        // Show the modal
        modal.show();
    }

    // Handle row clicks
    rows.forEach(row => {
        row.addEventListener('click', function (e) {
            // Prevent row click if the action button is clicked
            if (e.target.closest('.view-details')) {
                return;
            }
            const saleItem = JSON.parse(this.getAttribute('data-details'));
            showProductDetails(saleItem);
        });
    });

    // Handle view button clicks
    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const saleItem = JSON.parse(this.getAttribute('data-details'));
            showProductDetails(saleItem);
        });
    });

    // Initialize tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
});
</script>