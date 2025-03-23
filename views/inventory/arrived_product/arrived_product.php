<div class="container mt-4">
    <!-- <h1>Arrived Products</h1> -->
    
    <!-- Summary Panel -->
    <div class="row mb-2">
        <?php
            // Initialize an array to store unique product details (name, total quantity, and supplier)
            $arrivedProductsGroupedByName = [];

            // Loop through the arrived products
            foreach ($arrivedProducts as $arrivedProduct) {
                if ($arrivedProduct['expected_delivery'] === 'Arrived') {
                    // Check if the product name is already in the array
                    if (isset($arrivedProductsGroupedByName[$arrivedProduct['product_name']])) {
                        // If the product exists, sum the quantity
                        $arrivedProductsGroupedByName[$arrivedProduct['product_name']]['quantity'] += $arrivedProduct['quantity'];
                    } else {
                        // If the product doesn't exist, add it to the array with its quantity and supplier
                        $arrivedProductsGroupedByName[$arrivedProduct['product_name']] = [
                            'name' => $arrivedProduct['product_name'],
                            'quantity' => $arrivedProduct['quantity'],
                            'supplier' => $arrivedProduct['supplier']
                        ];
                    }
                }
            }

            // Count of unique products (based on product names)
            $totalArrived = count($arrivedProductsGroupedByName);
        ?>

        <!-- Total Products in Stock Card -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container position-relative">
                <div class="d-flex justify-content-between">
                    <div class="icon-right"><i class="fas fa-cube text-success fa-lg"></i></div>
                </div>
                <h5 class="h6 text-dark">Total Products in Stock</h5>
                <div class="value text-dark" style="font-size: 1.5rem;">
                    <?= $totalArrived ?> Products
                </div>
                <div class="orders text-dark" style="font-size: 0.9rem;">
                    Newly arrived products in store.
                </div>
                <!-- View icon positioned at top-right of the card -->
                <a href="#productListModal" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Modal for Product List -->
        <div class="modal fade" id="productListModal" tabindex="-1" aria-labelledby="productListModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productListModalLabel">Product List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($arrivedProductsGroupedByName as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                        <td><?= htmlspecialchars($product['quantity']) ?></td>
                                        <td><?= htmlspecialchars($product['supplier']) ?></td>
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
            // Initialize an array to store unique ready product information (name, total quantity, and supplier)
            $readyProductsGroupedByName = [];

            // Loop through the arrived products
            foreach ($arrivedProducts as $arrivedProduct) {
                if ($arrivedProduct['expected_delivery'] === 'Arrived' && $arrivedProduct['status'] === 'Ready') {
                    // Check if the product name is already in the array
                    if (isset($readyProductsGroupedByName[$arrivedProduct['product_name']])) {
                        // If the product exists, sum the quantity
                        $readyProductsGroupedByName[$arrivedProduct['product_name']]['quantity'] += $arrivedProduct['quantity'];
                    } else {
                        // If the product doesn't exist, add it to the array with its quantity and supplier
                        $readyProductsGroupedByName[$arrivedProduct['product_name']] = [
                            'name' => $arrivedProduct['product_name'],
                            'quantity' => $arrivedProduct['quantity'],
                            'supplier' => $arrivedProduct['supplier']
                        ];
                    }
                }
            }

            // Count the total number of ready products
            $readyProductCount = count($readyProductsGroupedByName);
        ?>

        <!-- Ready Products Card -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container position-relative">
                <div class="d-flex justify-content-between">
                    <div class="icon-right"><i class="fas fa-box-open text-success fa-lg"></i></div>
                </div>
                <h5 class="h6 text-dark">Ready Products</h5>
                <div class="value text-dark" style="font-size: 1.5rem;">
                    <?= $readyProductCount ?> Products
                </div>
                <div class="orders text-dark" style="font-size: 0.9rem;">
                    Approved and quality-tested for sale.
                </div>
                <!-- View icon positioned at top-right of the card -->
                <a href="#readyProductListModal" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Modal for Ready Product List -->
        <div class="modal fade" id="readyProductListModal" tabindex="-1" aria-labelledby="readyProductListModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="readyProductListModalLabel">Ready Product List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($readyProductsGroupedByName as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                        <td><?= htmlspecialchars($product['quantity']) ?></td>
                                        <td><?= htmlspecialchars($product['supplier']) ?></td>
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
            // Initialize an array to store unique product information (name, total quantity, and supplier)
            $pendingProductsGroupedByName = [];

            // Loop through the arrived products
            foreach ($arrivedProducts as $arrivedProduct) {
                if ($arrivedProduct['expected_delivery'] === 'Arrived' && $arrivedProduct['status'] === 'Pending') {
                    // Check if the product name is already in the array
                    if (isset($pendingProductsGroupedByName[$arrivedProduct['product_name']])) {
                        // If the product exists, sum the quantity
                        $pendingProductsGroupedByName[$arrivedProduct['product_name']]['quantity'] += $arrivedProduct['quantity'];
                    } else {
                        // If the product doesn't exist, add it to the array with its quantity and supplier
                        $pendingProductsGroupedByName[$arrivedProduct['product_name']] = [
                            'name' => $arrivedProduct['product_name'],
                            'quantity' => $arrivedProduct['quantity'],
                            'supplier' => $arrivedProduct['supplier']
                        ];
                    }
                }
            }

            // Count the total number of pending products
            $pendingProductCount = count($pendingProductsGroupedByName);
        ?>

        <!-- Pending Products Card -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container position-relative">
                <div class="d-flex justify-content-between">
                    <div class="icon-right"><i class="fas fa-hourglass-start text-warning fa-lg"></i></div>
                </div>
                <h5 class="h6 text-dark">Pending Products</h5>
                <div class="value text-dark" style="font-size: 1.5rem;">
                    <?= $pendingProductCount ?> Products
                </div>
                <div class="orders text-dark" style="font-size: 0.9rem;">
                    Awaiting testing before sale.
                </div>
                <!-- View icon positioned at top-right of the card -->
                <a href="#pendingProductListModal" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Modal for Pending Product List -->
        <div class="modal fade" id="pendingProductListModal" tabindex="-1" aria-labelledby="pendingProductListModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pendingProductListModalLabel">Pending Product List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendingProductsGroupedByName as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                        <td><?= htmlspecialchars($product['quantity']) ?></td>
                                        <td><?= htmlspecialchars($product['supplier']) ?></td>
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
            // Initialize an array to store unique supplier names
            $suppliers = [];

            // Loop through the arrived products
            foreach($arrivedProducts as $arrivedProduct) {
                if ($arrivedProduct['expected_delivery'] === 'Arrived') {
                    // Add the supplier name to the array if not already added
                    if (!in_array($arrivedProduct['supplier'], $suppliers)) {
                        $suppliers[] = $arrivedProduct['supplier'];
                    }
                }
            }

            // Count the unique suppliers
            $totalUniqueSuppliers = count($suppliers);
        ?>

        <!-- Supplier Card -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container position-relative">
                <div class="d-flex justify-content-between">
                    <!-- Updated Icon for Suppliers -->
                    <div class="icon-right"><i class="fas fa-handshake text-success fa-lg"></i></div>
                </div>
                <h5 class="h6 text-dark">Supplier</h5>
                <div class="value text-dark" style="font-size: 1.5rem;">
                    <?= $totalUniqueSuppliers ?> Suppliers
                </div>
                <div class="orders text-dark" style="font-size: 0.9rem;">
                    Suppliers of recent arrivals.
                </div>
                <!-- View icon positioned at top-right of the card -->
                <a href="#supplierListModal" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" title="View Supplier Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Modal for Supplier List -->
        <div class="modal fade" id="supplierListModal" tabindex="-1" aria-labelledby="supplierListModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierListModalLabel">Supplier List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <?php foreach ($suppliers as $supplier): ?>
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
        
    </div>

    

    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Order" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
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
                        <th>Status</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="switchTableBody">
                    <?php foreach($arrivedProducts as $arrivedProduct): ?>
                        <?php if ($arrivedProduct['expected_delivery'] === 'Arrived'): ?>
                            <tr class="border-bottom" onclick="showProductDetails(
                                '<?= htmlspecialchars($arrivedProduct['id']) ?>',
                                '<?= htmlspecialchars($arrivedProduct['product_name']) ?>',
                                '<?= htmlspecialchars($arrivedProduct['quantity']) ?>',
                                '<?= htmlspecialchars($arrivedProduct['order_date']) ?>',
                                '<?= htmlspecialchars($arrivedProduct['supplier']) ?>',
                                '<?= htmlspecialchars($arrivedProduct['status']) ?>'
                            )" style="cursor: pointer;">
                                <td><?= htmlspecialchars($arrivedProduct['id']) ?></td>
                                <td><?= htmlspecialchars($arrivedProduct['product_name']) ?></td>
                                <td><?= htmlspecialchars($arrivedProduct['quantity']) ?></td>
                                <td><?= htmlspecialchars($arrivedProduct['order_date']) ?></td>
                                <td>
                                    <span class="badge bg-success">Arrived</span>
                                </td>
                                <td><?= htmlspecialchars($arrivedProduct['supplier']) ?></td>
                                <td>
                                    <?php if ($arrivedProduct['status'] === 'Ready'): ?>
                                        <span class="badge bg-success"><?= htmlspecialchars($arrivedProduct['status']) ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-warning"><?= htmlspecialchars($arrivedProduct['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0 m-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical fs-5"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item text-warning" href="/arrived_product/edit/<?= $arrivedProduct['id'] ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="/arrived_product/delete/<?= $arrivedProduct['id'] ?>" onclick="return confirm('Are you sure you want to delete this order?');">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination Component -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div id="entriesInfo" class="text-muted">
                    Showing 1 to <?= count($arrivedProducts) ?> of <?= count($arrivedProducts) ?> entries
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
            <div class="d-flex justify-content-start mt-3">
                <a href="/order_new_product" class="btn btn-secondary">Back</a>
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
                <p><strong>Supplier:</strong> <span id="modal-supplier"></span></p>
                <p><strong>Status:</strong> <span id="modal-status"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
function showProductDetails(id, productName, quantity, orderDate, supplier, status) {
    // Prevent clicking on the dropdown button or link
    if (event.target.closest(".dropdown") || event.target.closest("button") || event.target.closest("a")) {
        return;
    }

    // Set the data in the modal
    document.getElementById("modal-order-id").textContent = id;
    document.getElementById("modal-product-name").textContent = productName;
    document.getElementById("modal-quantity").textContent = quantity;
    document.getElementById("modal-order-date").textContent = orderDate;
    document.getElementById("modal-supplier").textContent = supplier;
    document.getElementById("modal-status").textContent = status;

    // Show the modal using Bootstrap's modal API
    let modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
    modal.show();
}
</script>

