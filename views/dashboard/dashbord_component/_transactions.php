<!-- Stock Products Card -->
<div class="col-md-6 col-lg-4 order-2 mb-3 animate-fade-in">
    <div class="card h-100 border-0">
        <div class="d-flex align-items-center justify-content-between bg-light border-bottom-0">
            <h5 class="card-title m-0 me-2 text-dark">Stock Products</h5>
            <div class="dropdown">
                <button
                    class="btn p-0 text-muted"
                    type="button"
                    id="lowStockID"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded fs-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="/product_list">View Details</a>
                    <a class="dropdown-item" href="#" onclick="handleRefresh(event)">Refresh</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="p-0 m-0 stock-products-list">
                <!-- Debug: Log the variables -->
                <?php
                // Ensure variables are defined before logging
                $low_stock_products = $low_stock_products ?? [];
                $out_of_stock_products = $out_of_stock_products ?? [];

                error_log("Low stock products in transactions.php: " . print_r($low_stock_products, true));
                error_log("Out of stock products in transactions.php: " . print_r($out_of_stock_products, true));
                ?>

                <!-- Low Stock Products Section -->
                <li class="d-flex mb-2 align-items-center">
                    <div class="me-2 flex-grow-1">
                        <h6 class="mb-0 text-warning" data-bs-toggle="collapse" href="#lowStockCollapse" role="button" aria-expanded="true" aria-controls="lowStockCollapse">
                            <i class="bx bx-error-circle me-2"></i>Low Stock (1-5 Units)
                            <i class="bx bx-chevron-down collapse-icon ms-2"></i>
                        </h6>
                    </div>
                </li>
                <div class="collapse show" id="lowStockCollapse">
                    <?php if (!empty($low_stock_products)): ?>
                        <?php foreach ($low_stock_products as $product): ?>
                            <?php
                            // Calculate progress for low stock (assuming 5 units is 100%)
                            $progress_percentage = ($product['stock_quantity'] / 5) * 100;
                            ?>
                            <li class="d-flex mb-2 pb-1 stock-item">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2 flex-grow-1">
                                        <h6 class="mb-1 text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Restock soon"><?php echo htmlspecialchars($product['name']); ?></h6>
                                        <div class="progress stock-progress">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $progress_percentage; ?>%;" aria-valuenow="<?php echo $product['stock_quantity']; ?>" aria-valuemin="0" aria-valuemax="5"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-warning-subtle text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Units remaining"><?php echo htmlspecialchars($product['stock_quantity']); ?></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="d-flex mb-2 pb-1 text-muted">
                            <div class="me-2">
                                <h6 class="mb-0">No low stock products</h6>
                            </div>
                        </li>
                    <?php endif; ?>
                </div>

                <!-- Divider -->
                <li class="d-flex mb-2">
                    <hr class="w-100 custom-divider" />
                </li>

                <!-- Out of Stock Products Section -->
                <li class="d-flex mb-2 align-items-center">
                    <div class="me-2 flex-grow-1">
                        <h6 class="mb-0 text-danger" data-bs-toggle="collapse" href="#outOfStockCollapse" role="button" aria-expanded="true" aria-controls="outOfStockCollapse">
                            <i class="bx bx-x-circle me-2"></i>Out of Stock (0 Units)
                            <i class="bx bx-chevron-down collapse-icon ms-2"></i>
                        </h6>
                    </div>
                </li>
                <div class="collapse show" id="outOfStockCollapse">
                    <?php if (!empty($out_of_stock_products)): ?>
                        <?php foreach ($out_of_stock_products as $product): ?>
                            <li class="d-flex mb-2 pb-1 stock-item">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2 flex-grow-1">
                                        <h6 class="mb-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Out of stock"><?php echo htmlspecialchars($product['name']); ?></h6>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger-subtle text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Units remaining"><?php echo htmlspecialchars($product['stock_quantity']); ?></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="d-flex mb-2 pb-1 text-muted">
                            <div class="me-2">
                                <h6 class="mb-0">No out of stock products</h6>
                            </div>
                        </li>
                    <?php endif; ?>
                </div>
            </ul>
        </div>
    </div>
</div>

<style>
    /* Modern font stack for professionalism */
    body,
    .stock-products-list,
    .card {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    /* Simplified fade-in animation */
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Card styling */
    .card {
        border-radius: 8px;
    }

    /* Card header and body padding */
    .card-header {
        padding: 1rem 1.25rem;
        background-color: #f8f9fa;
        border-bottom: none;
    }

    .card-body {
        padding: 1.25rem 1.5rem;
    }

    /* Stock products list styling */
    .stock-products-list .stock-item {
        padding: 10px;
        margin-bottom: 6px;
    }

    .stock-products-list .custom-divider {
        border-top: 1px dashed #dee2e6;
        margin: 0.5rem 0;
    }

    /* Typography */
    .stock-products-list h6 {
        font-size: 1rem;
        font-weight: 400;
        margin-bottom: 0;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 500;
    }

    /* Collapsible section icon */
    .collapse-icon {
        /* No rotation animation */
    }

    /* Badge styling */
    .badge {
        font-size: 0.9rem;
        font-weight: 400;
        padding: 0.3em 0.6em;
        border-radius: 12px;
    }

    .bg-warning-subtle {
        background-color: #fef3c7 !important;
        color: #92400e !important;
    }

    .bg-danger-subtle {
        background-color: #fee2e2 !important;
        color: #991b1b !important;
    }

    /* Progress bar for low stock */
    .stock-progress {
        height: 6px;
        border-radius: 4px;
        background-color: #e9ecef;
    }

    .stock-progress .progress-bar {
        background-color: #f59e0b;
    }

    /* Simplified tooltip styling */
    .tooltip-inner {
        background-color: #1f2937;
        color: #fff;
        padding: 0.4rem 0.6rem;
        font-size: 0.85rem;
    }

    .bs-tooltip-top .tooltip-arrow::before {
        border-top-color: #1f2937;
    }

    .bs-tooltip-bottom .tooltip-arrow::before {
        border-bottom-color: #1f2937;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }

        .stock-products-list .stock-item {
            padding: 8px;
        }

        .stock-products-list h6 {
            font-size: 0.95rem;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.25em 0.5em;
        }

        .card-title {
            font-size: 1.1rem;
        }
    }
</style>

<script>
    // Initialize Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>