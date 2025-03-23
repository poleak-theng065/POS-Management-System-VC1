<div class="container mt-4">
    <!-- <h1>Order Details</h1> -->

    <div class="row text-center">
        <?php
            // Instantiate the ProductModel class
            $productModel = new ProductModel();

            // Retrieve the count of low stock products and out of stock products from the database
            $lowStockCount = $productModel->getLowStockProductsCount();  // Fetches low stock product count
            $outOfStockCount = $productModel->getOutOfStockProductsCount();  // Fetches out of stock product count
        ?>

        <!-- Need to Order -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container position-relative">
                <!-- Title with Icon -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="icon-right">
                        <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                    </div>
                </div>

                <!-- Need to Order text in center at the top -->
                <div class="text-center">
                    <h5 class="h6 text-dark">Need to Order</h5>
                </div>

                <div class="d-flex justify-content-between">
                    <!-- Display Low Stock Count -->
                    <div class="low-stock text-center" style="flex: 1;">
                        <div class="value text-dark" style="font-size: 2rem; font-weight: bold;">
                            <?= $lowStockCount ?>
                        </div>
                        <div class="text-dark" style="font-size: 0.9rem;">
                            Low Stock
                        </div>
                    </div>

                    <!-- Display Out of Stock Count -->
                    <div class="out-of-stock text-center" style="flex: 1;">
                        <div class="value text-dark" style="font-size: 2rem; font-weight: bold;">
                            <?= $outOfStockCount ?>
                        </div>
                        <div class="text-dark" style="font-size: 0.9rem;">
                            Out of Stock
                        </div>
                    </div>
                </div>

                <!-- View icon positioned at top-right -->
                <a href="/run_out_and_low_stock_product" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>



            <?php
                // Count the number of arrived products
                $totalArrived = 0;
                foreach ($newOrders as $newOrder) {
                    if ($newOrder['expected_delivery'] === 'Arrived') {
                        $totalArrived++;
                    }
                }
            ?>

            <!-- Arrived Product -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container position-relative">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-box-open text-success fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Arrived</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalArrived ?> Products
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Newly arrived stock ready for sale.
                    </div>
                    <!-- View icon positioned at top-right of the card -->
                    <a href="/arrived_product" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>


            <?php
                // Count the number of delivery products
                $totalDelivery = 0;
                foreach ($newOrders as $newOrder) {
                    if ($newOrder['expected_delivery'] === 'Delivery') {
                        $totalDelivery++;
                    }
                }
            ?>
            <!-- Delivery Product -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container position-relative">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-truck text-primary fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Delivery</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalDelivery ?> Products
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Products on the way for delivery.
                    </div>
                    <!-- View icon positioned at top-right of the card -->
                    <a href="/delivery" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>


            <?php
                // Count the number of order products
                $totalOrders = 0;
                foreach ($newOrders as $newOrder) {
                    if ($newOrder['expected_delivery'] === 'Order') {
                        $totalOrders++;
                    }
                }
            ?>
            <!-- Total Order -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container ">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-shopping-cart text-info fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Orders</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalOrders ?> Orders
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Total number of orders placed.
                    </div>
                    <!-- View icon positioned at top-right of the card -->
                    <a href="/order_list" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

        </div>


    <!-- Total Orders Modal -->
    <div class="modal fade" id="totalOrdersModal" tabindex="-1" aria-labelledby="totalOrdersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="totalOrdersModalLabel">Total Orders List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php
                        foreach ($newOrders as $order): ?>
                            <li class="list-group-item">
                                <?= htmlspecialchars($order['product_name']) ?> - <?= htmlspecialchars($order['quantity']) ?> items
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Supplier Modal -->
    <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supplierModalLabel">Supplier List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php
                        $suppliers = array_unique(array_column($newOrders, 'supplier'));
                        foreach ($suppliers as $supplier): ?>
                            <li class="list-group-item"><?= htmlspecialchars($supplier) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Arrived Items Modal -->
    <div class="modal fade" id="arrivedItemsModal" tabindex="-1" aria-labelledby="arrivedItemsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="arrivedItemsModalLabel">Arrived Items List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php
                        $arrivedItems = array_filter($newOrders, fn($order) => $order['expected_delivery'] === 'Arrived');
                        foreach ($arrivedItems as $item): ?>
                            <li class="list-group-item"><?= htmlspecialchars($item['product_name']) ?> - <?= htmlspecialchars($item['quantity']) ?> items</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Items Modal -->
    <div class="modal fade" id="pendingItemsModal" tabindex="-1" aria-labelledby="pendingItemsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pendingItemsModalLabel">Pending Items List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php
                        $pendingItems = array_filter($newOrders, fn($order) => $order['expected_delivery'] === 'Order');
                        foreach ($pendingItems as $item): ?>
                            <li class="list-group-item"><?= htmlspecialchars($item['product_name']) ?> - <?= htmlspecialchars($item['quantity']) ?> items</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
            <a href="/order_new_product/create" class="btn btn-primary ms-2">+ Add New Order</a>
        </div>

        <div class="mb-3">
            <label for="fileUpload" class="form-label">Upload Orders (PDF or Excel)</label>
            <input type="file" class="form-control" id="fileUpload" accept=".pdf, .xls, .xlsx">
            <button class="btn btn-success mt-2" id="uploadButton">Upload</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="orderTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Expected Delivery</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="switchTableBody">
                    <?php foreach($newOrders as $newOrder): ?>
                    <tr class="border-bottom" 
                        data-id="<?= htmlspecialchars($newOrder['id']) ?>" 
                        data-product-name="<?= htmlspecialchars($newOrder['product_name']) ?>" 
                        data-quantity="<?= htmlspecialchars($newOrder['quantity']) ?>" 
                        data-order-date="<?= htmlspecialchars($newOrder['order_date']) ?>" 
                        data-expected-delivery="<?= htmlspecialchars($newOrder['expected_delivery']) ?>" 
                        data-supplier="<?= htmlspecialchars($newOrder['supplier']) ?>"
                        onclick="showProductDetails(event)"
                        style="cursor: pointer;">
                        
                        <td><?= htmlspecialchars($newOrder['id']) ?></td>
                        <td><?= htmlspecialchars($newOrder['product_name']) ?></td>
                        <td><?= htmlspecialchars($newOrder['quantity']) ?></td>
                        <td><?= htmlspecialchars($newOrder['order_date']) ?></td>
                        <td>
                            <?php if ($newOrder['expected_delivery'] === 'Delivery'): ?>
                                <span class="badge bg-info">Delivery</span>
                            <?php elseif ($newOrder['expected_delivery'] === 'Arrived'): ?>
                                <span class="badge bg-success">Arrived</span>
                            <?php elseif ($newOrder['expected_delivery'] === 'Order'): ?>
                                <span class="badge bg-primary">Order</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= htmlspecialchars($newOrder['expected_delivery']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($newOrder['supplier']) ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0 m-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item text-warning" href="/order_new_product/edit/<?= $newOrder['id'] ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="/order_new_product/delete/<?= $newOrder['id'] ?>" onclick="return confirm('Are you sure you want to delete this order?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>


            </table>

            <!-- Pagination Component -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div id="entriesInfo" class="text-muted">
                    Showing 1 to <?= count($newOrders) ?> of <?= count($newOrders) ?> entries
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
</div>


<!-- Bootstrap Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailsLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Order ID:</strong> <span id="modal-order-id"></span></p>
                <p><strong>Product Name:</strong> <span id="modal-product-name"></span></p>
                <p><strong>Quantity:</strong> <span id="modal-quantity"></span></p>
                <p><strong>Order Date:</strong> <span id="modal-order-date"></span></p>
                <p><strong>Expected Delivery:</strong> <span id="modal-expected-delivery"></span></p>
                <p><strong>Supplier:</strong> <span id="modal-supplier"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
function showProductDetails(event) {
    let target = event.target;

    // Prevent click on dropdown menu from triggering modal
    if (target.closest(".dropdown") || target.closest("button") || target.closest("a")) {
        return;
    }

    let row = target.closest("tr");
    if (row) {
        // Set modal data
        document.getElementById("modal-order-id").textContent = row.getAttribute("data-id");
        document.getElementById("modal-product-name").textContent = row.getAttribute("data-product-name");
        document.getElementById("modal-quantity").textContent = row.getAttribute("data-quantity");
        document.getElementById("modal-order-date").textContent = row.getAttribute("data-order-date");
        document.getElementById("modal-expected-delivery").textContent = row.getAttribute("data-expected-delivery");
        document.getElementById("modal-supplier").textContent = row.getAttribute("data-supplier");

        // Show the Bootstrap modal
        let modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
        modal.show();
    }
}
</script>

