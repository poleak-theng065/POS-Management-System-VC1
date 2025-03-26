<div class="container mt-4">
    <!-- <h1>Order Details</h1> -->

    <div class="row text-center">
        <?php
        // Instantiate the RunOutAndLowStockProductModel class
        $productModel = new RunOutAndLowStockProductModel();

        // Retrieve the low stock and out of stock products from the database
        $lowAndOutOfStockProducts = $productModel->getRunOutAndLowStockProduct();  // Fetches products with stock <= 5
        $lowStockCount = count(array_filter($lowAndOutOfStockProducts, function ($product) {
            return $product['stock_quantity'] <= 5 && $product['stock_quantity'] > 0;
        })); // Count of low stock products
        $outOfStockCount = count(array_filter($lowAndOutOfStockProducts, function ($product) {
            return $product['stock_quantity'] == 0;
        })); // Count of out of stock products
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
                <a href="#" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Modal for showing low stock and out of stock product details -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger fw-bold fs-4" id="orderDetailsModalLabel">
                            <i class="bi bi-box-arrow-down-right me-2"></i> Low and Out of Stock Products
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="orderDetailsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="lowStockTab" data-bs-toggle="tab" href="#lowStock" role="tab" aria-controls="lowStock" aria-selected="true">Low Stock</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="outOfStockTab" data-bs-toggle="tab" href="#outOfStock" role="tab" aria-controls="outOfStock" aria-selected="false">Out of Stock</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="orderDetailsTabContent">
                            <!-- Low Stock Tab -->
                            <div class="tab-pane fade show active" id="lowStock" role="tabpanel" aria-labelledby="lowStockTab">
                                <h6 class="text-warning fw-bold fs-5 mb-3">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Low Stock Products
                                </h6>


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Barcode</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($lowAndOutOfStockProducts as $product): ?>
                                            <?php if ($product['stock_quantity'] <= 5 && $product['stock_quantity'] > 0): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($product['barcode']) ?></td>
                                                    <td><?= htmlspecialchars($product['name']) ?></td>
                                                    <td><?= htmlspecialchars($product['brand']) ?></td>
                                                    <td><?= htmlspecialchars($product['type']) ?></td>
                                                    <td><?= htmlspecialchars($product['status']) ?></td>
                                                    <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Out of Stock Tab -->
                            <div class="tab-pane fade" id="outOfStock" role="tabpanel" aria-labelledby="outOfStockTab">
                                <h6 class="text-danger fw-bold fs-5 mb-3">
                                    <i class="bi bi-cart-x-fill me-2"></i> Out of Stock Products
                                </h6>



                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Barcode</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($lowAndOutOfStockProducts as $product): ?>
                                            <?php if ($product['stock_quantity'] == 0): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($product['barcode']) ?></td>
                                                    <td><?= htmlspecialchars($product['name']) ?></td>
                                                    <td><?= htmlspecialchars($product['brand']) ?></td>
                                                    <td><?= htmlspecialchars($product['type']) ?></td>
                                                    <td><?= htmlspecialchars($product['status']) ?></td>
                                                    <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
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


            <!-- Delivery card -->
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
                    <a href="#" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" data-bs-target="#deliveryDetailsModal" title="View Details" onclick="loadDeliveryDetails()">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Modal to display delivery details -->
            <div class="modal fade" id="deliveryDetailsModal" tabindex="-1" aria-labelledby="deliveryDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title text-primary fw-bold fs-4" id="deliveryDetailsModalLabel">
                                <i class="fas fa-truck text-primary me-2"></i> Delivery Products
                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Order Date</th>
                                        <th>Supplier</th> <!-- Added Supplier column -->
                                    </tr>
                                </thead>
                                <tbody id="deliveryProductList">
                                    <script>
                                        function loadDeliveryDetails() {
                                            // The array of delivery products
                                            const deliveryProducts = [
                                                <?php foreach ($newOrders as $newOrder): ?>
                                                    <?php if ($newOrder['expected_delivery'] === 'Delivery'): ?>
                                                        {
                                                            "id": "<?= htmlspecialchars($newOrder['id']) ?>",
                                                            "product_name": "<?= htmlspecialchars($newOrder['product_name']) ?>",
                                                            "quantity": "<?= htmlspecialchars($newOrder['quantity']) ?>",
                                                            "order_date": "<?= htmlspecialchars($newOrder['order_date']) ?>",
                                                            "supplier": "<?= htmlspecialchars($newOrder['supplier']) ?>" <!-- Added supplier -->
                                                        },
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            ];

                                            // Get the table body where the delivery products will be listed
                                            const tableBody = document.getElementById("deliveryProductList");

                                            // Clear any previous content in the table body
                                            tableBody.innerHTML = '';

                                            // Loop through the delivery products and insert them into the table
                                            deliveryProducts.forEach(product => {
                                                const row = document.createElement('tr');
                                                row.innerHTML = `
                                                    <td>${product.id}</td>
                                                    <td>${product.product_name}</td>
                                                    <td>${product.quantity}</td>
                                                    <td>${product.order_date}</td>
                                                    <td>${product.supplier}</td> <!-- Added supplier data -->
                                                `;
                                                tableBody.appendChild(row);
                                            });
                                        }
                                    </script>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Order card -->
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
                <div class="card p-3 card-container">
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
                    <a href="#" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" data-bs-target="#orderProductModal" title="View Details" onclick="loadOrderDetails()">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Modal to display order details -->
            <div class="modal fade" id="orderProductModal" tabindex="-1" aria-labelledby="orderProductModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-info fw-bold fs-4" id="orderProductModalLabel">
                                <i class="fas fa-shopping-cart text-info me-2"></i> Order Products
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Order Date</th>
                                        <th>Supplier</th>
                                    </tr>
                                </thead>
                                <tbody id="orderProductList">
                                    <!-- Data will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function loadOrderDetails() {
                    // The array of order products
                    const orderProducts = [
                        <?php foreach ($newOrders as $newOrder): ?>
                            <?php if ($newOrder['expected_delivery'] === 'Order'): ?>
                                {
                                    "id": "<?= htmlspecialchars($newOrder['id']) ?>",
                                    "product_name": "<?= htmlspecialchars($newOrder['product_name']) ?>",
                                    "quantity": "<?= htmlspecialchars($newOrder['quantity']) ?>",
                                    "order_date": "<?= htmlspecialchars($newOrder['order_date']) ?>",
                                    "supplier": "<?= htmlspecialchars($newOrder['supplier']) ?>"
                                },
                            <?php endif; ?>
                        <?php endforeach; ?>
                    ];

                    // Get the table body where the order products will be listed
                    const tableBody = document.getElementById("orderProductList");

                    // Clear any previous content in the table body
                    tableBody.innerHTML = '';

                    // Loop through the order products and insert them into the table
                    orderProducts.forEach(product => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${product.id}</td>
                            <td>${product.product_name}</td>
                            <td>${product.quantity}</td>
                            <td>${product.order_date}</td>
                            <td>${product.supplier}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            </script>
        </div>

    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex">
                <input type="text" class="form-control me-2" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
                <select class="form-select" id="filterSelect" onchange="filterOrders()" style="width: 200px;">
                    <option value="">Filter by Status</option>
                    <option value="Delivery">Delivery</option>
                    <option value="Arrived">Arrived</option>
                    <option value="Order">Order</option>
                </select>
            </div>

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
                        <th>Price USD</th>
                        <th>Total USD</th>
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
                        data-base-price-usd="<?= htmlspecialchars($newOrder['base_price_usd']) ?>"
                        data-total-price-usd="<?= htmlspecialchars($newOrder['total_price_usd']) ?>"
                        data-order-date="<?= htmlspecialchars($newOrder['order_date']) ?>" 
                        data-expected-delivery="<?= htmlspecialchars($newOrder['expected_delivery']) ?>" 
                        data-supplier="<?= htmlspecialchars($newOrder['supplier']) ?>"
                        onclick="showProductDetails(event)"
                        style="cursor: pointer;">
                        
                        <td><?= htmlspecialchars($newOrder['id']) ?></td>
                        <td><?= htmlspecialchars($newOrder['product_name']) ?></td>
                        <td><?= htmlspecialchars($newOrder['quantity']) ?></td>
                        <td><?= htmlspecialchars($newOrder['base_price_usd']) ?></td>
                        <td><?= htmlspecialchars($newOrder['total_price_usd']) ?></td>
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
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="openDeleteModal('<?= htmlspecialchars($newOrder['product_name']) ?>', '/order_new_product/delete/<?= $newOrder['id'] ?>')">
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
                <p><strong>Base Price USD:</strong> <span id="modal-base_price_usd"></span></p>
                <p><strong>Total Price USD:</strong> <span id="modal-total_price_usd"></span></p>
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
        document.getElementById("modal-base_price_usd").textContent = row.getAttribute("data-base-price-usd");
        document.getElementById("modal-total_price_usd").textContent = row.getAttribute("data-total-price-usd");

        // Show the Bootstrap modal
        let modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
        modal.show();
    }
}
</script>

<!-- Filter  -->
 <script>
    // Function to filter orders based on the selected status
    function filterOrders() {
        // Get the selected value from the dropdown
        const filterValue = document.getElementById('filterSelect').value;
        
        // Get all table rows
        const rows = document.querySelectorAll('#switchTableBody tr');
        
        // Loop through the rows and check the expected_delivery value
        rows.forEach(row => {
            // Get the expected_delivery value from the data attribute
            const expectedDelivery = row.getAttribute('data-expected-delivery');
            
            // If no filter is selected, show all rows
            if (filterValue === '' || expectedDelivery === filterValue) {
                row.style.display = '';  // Show the row
            } else {
                row.style.display = 'none';  // Hide the row
            }
        });
    }

 </script>


<!-- Modal for Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this order?</p>
                <p id="productName" class="fw-bold"></p> <!-- To display the product name -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm delete -->
<script>
// Function to open the modal and set the product name and delete URL
function openDeleteModal(productName, deleteUrl) {
    // Set the product name in the modal
    document.getElementById('productName').textContent = productName;
    
    // Set the delete URL in the button's data attribute
    document.getElementById('confirmDeleteButton').setAttribute('data-delete-url', deleteUrl);
    
    // Show the modal
    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    myModal.show();
}

// Function to confirm the deletion
document.getElementById('confirmDeleteButton').addEventListener('click', function() {
    var deleteUrl = this.getAttribute('data-delete-url');
    window.location.href = deleteUrl; // Redirect to the delete URL
});
</script>