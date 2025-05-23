<?php require_once __DIR__ . '/../../../Models/inventory/RunOutAndLowStockProductModel.php'; ?>

<?php session_start(); ?> 
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>


<div class="container mt-4">

    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block" 
        style="border-left: 8px solid #71DD37; background-color: #f8f9fa;">
        <i class="bi bi-box-arrow-in-down" style="color: #71DD37; margin-right: 0.5rem;"></i> 
        Import Product - Items to be Imported
    </h1>


    <div class="row  d-flex align-items-stretch">
        <?php
        // Instantiate the RunOutAndLowStockProductModel class
        $productModel = new RunOutAndLowStockProductModel();

        // Retrieve the low stock and out of stock products from the database
        $lowAndOutOfStockProducts = $productModel->getRunOutAndLowStockProduct(); 
        $lowStockCount = count(array_filter($lowAndOutOfStockProducts, function ($product) {
            return $product['stock_quantity'] <= 5 && $product['stock_quantity'] > 0;
        })); // Count of low stock products
        $outOfStockCount = count(array_filter($lowAndOutOfStockProducts, function ($product) {
            return $product['stock_quantity'] == 0;
        })); // Count of out of stock products
        ?>

        <!-- Need to Order -->
        <div class="col-md-3 mb-4 d-flex mt-2">
            <div class="card p-3 flex-grow-1 d-flex flex-column position-relative text-center">
                <div class="d-flex justify-content-between">
                    <div class="icon-left">
                        <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                    </div>
                </div>
                <h5 class="h6 text-dark mt-2 mb-0">Need to Order</h5>
                <div class="d-flex justify-content-between mt-3 flex-grow-1 text-center">
                    <div class="low-stock" style="flex: 1;">
                        <div class="value text-dark" style="font-size: 2rem; font-weight: bold;">
                            <?= $lowStockCount ?>
                        </div>
                        <div class="text-dark" style="font-size: 0.9rem;">Low Stock</div>
                    </div>
                    <div class="out-of-stock" style="flex: 1;">
                        <div class="value text-dark" style="font-size: 2rem; font-weight: bold;">
                            <?= $outOfStockCount ?>
                        </div>
                        <div class="text-dark" style="font-size: 0.9rem;">Out of Stock</div>
                    </div>
                </div>
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
                                            <th>Product</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($lowAndOutOfStockProducts as $product): ?>
                                            <?php if ($product['stock_quantity'] <= 5 && $product['stock_quantity'] > 0): ?>
                                                <tr class="border-bottom">
                                                    <td><?= htmlspecialchars($product['barcode']) ?></td>
                                                    <td>
                                                        <div class="product-image-container">
                                                            <img src="<?= !empty($product['image_path']) ? 'assets/img/upload/' . $product['image_path'] : '/path/to/default/image.png' ?>" 
                                                                alt="Product Image" class="product-image">
                                                        </div>
                                                        
                                                        <?= $product['name'] ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($product['brand']) ?></td>
                                                    <td><?= htmlspecialchars($product['type']) ?></td>
                                                    <td><?= htmlspecialchars($product['status']) ?></td>
                                                    <td class="text-warning"><?= htmlspecialchars($product['stock_quantity']) ?></td>
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
                                            <th>Product</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($lowAndOutOfStockProducts as $product): ?>
                                            <?php if ($product['stock_quantity'] == 0): ?>
                                                <tr  class="border-bottom">
                                                    <td><?= htmlspecialchars($product['barcode']) ?></td>
                                                    <td>
                                                        <div class="product-image-container">
                                                            <img src="<?= !empty($product['image_path']) ? 'assets/img/upload/' . $product['image_path'] : '/path/to/default/image.png' ?>" 
                                                                alt="Product Image" class="product-image">
                                                        </div>
                                                        <?= $product['name'] ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($product['brand']) ?></td>
                                                    <td><?= htmlspecialchars($product['type']) ?></td>
                                                    <td><?= htmlspecialchars($product['status']) ?></td>
                                                    <td class="text-danger"><?= htmlspecialchars($product['stock_quantity']) ?></td>
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
            <div class="col-md-3 mb-4 d-flex mt-2">
                <div class="card p-3 flex-grow-1 d-flex flex-column position-relative text-center">
                    <div class="d-flex justify-content-between">
                        <div class="icon-left">
                            <i class="fas fa-box-open text-success fa-lg"></i>
                        </div>
                    </div>
                    <h5 class="h6 text-dark mt-2 mb-0">Arrived</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalArrived ?> Products
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Newly arrived stock ready for sale.
                    </div>
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
            <div class="col-md-3 mb-4 d-flex mt-2">
                <div class="card p-3 flex-grow-1 d-flex flex-column position-relative text-center">
                    <div class="d-flex justify-content-between">
                        <div class="icon-left">
                            <i class="fas fa-truck text-primary fa-lg"></i>
                        </div>
                    </div>
                    <h5 class="h6 text-dark mt-2 mb-0">Delivery</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalDelivery ?> Products
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Products on the way for delivery.
                    </div>
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
                                    <tr  class="border-bottom">
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Order Date</th>
                                        <th>Supplier</th> 
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
                                                            "image_path": "<?= !empty($newOrder['image_path']) ? 'assets/img/upload/' . $newOrder['image_path'] : '/path/to/default/image.png' ?>",
                                                            "product_name": "<?= htmlspecialchars($newOrder['product_name']) ?>",
                                                            "quantity": "<?= htmlspecialchars($newOrder['quantity']) ?>",
                                                            "order_date": "<?= htmlspecialchars($newOrder['order_date']) ?>",
                                                            "supplier": "<?= htmlspecialchars($newOrder['supplier']) ?>"
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
                                                row.classList.add('border-bottom'); // Add border-bottom class to the row
                                                row.innerHTML = `
                                                    <td>${product.id}</td>
                                                    <td>
                                                        <div class="product-image-container">
                                                            <img src="${product.image_path}" alt="Product Image" class="product-image">
                                                        </div>
                                                        ${product.product_name}
                                                    </td>
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
             <div class="col-md-3 mb-4 d-flex mt-2">
                <div class="card p-3 flex-grow-1 d-flex flex-column position-relative text-center">
                    <div class="d-flex justify-content-between">
                        <div class="icon-left">
                            <i class="fas fa-shopping-cart text-info fa-lg"></i>
                        </div>
                    </div>
                    <h5 class="h6 text-dark mt-2 mb-0">Orders</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                        <?= $totalOrders ?> Orders
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Total number of orders placed.
                    </div>
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
                                        <th>Product</th>
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
                                    "image_path": "<?= !empty($newOrder['image_path']) ? 'assets/img/upload/' . $newOrder['image_path'] : '/path/to/default/image.png' ?>",
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
                        row.classList.add('border-bottom'); // Add border-bottom class to the row
                        row.innerHTML = `
                            <td>${product.id}</td>
                            <td>
                                <div class="product-image-container">
                                    <img src="${product.image_path}" alt="Product Image" class="product-image">
                                </div>
                                ${product.product_name}
                            </td>
                            <td>${product.quantity}</td>
                            <td>${product.order_date}</td>
                            <td>${product.supplier}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            </script>
        </div>
        <!-- <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block" 
            style="border-left: 8px solid #0d6efd; background-color: #f8f9fa;">
            <i class="bi bi-box-arrow-in-down text-primary me-2"></i> Import Product - Items to be Imported
        </h1> -->

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
                <!-- Buttons and Export Dropdown -->
                <div class="d-flex align-items-center">
                    <div class="btn-group me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark-arrow-down me-2"></i> Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportButton">
                            <li>
                                <form method="POST">
                                    <button type="submit" name="export_excel" class="dropdown-item">
                                        <i class="bi bi-file-earmark-excel me-2"></i> Export to Excel
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form method="POST">
                                    <button type="submit" name="export_pdf" class="dropdown-item">
                                        <i class="bi bi-file-earmark-pdf me-2"></i> Export to PDF
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <a href="/order_new_product/create" class="btn btn-primary">+ Add New Order</a>
                </div>
                
            </div>

            <!-- <form action="/order_new_product/upload" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fileUpload" class="form-label">Upload Orders (Excel Only)</label>
                    <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept=".xls, .xlsx">
                </div>
                <button type="submit" class="btn btn-success mt-2">Upload</button>
            </form> -->




            <div class="table-responsive">
                <table class="table table-hover align-middle" id="orderTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
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
                            <tr class="border-bottom search" 
                                data-id="<?= htmlspecialchars($newOrder['id']) ?>" 
                                data-product-name="<?= htmlspecialchars($newOrder['product_name']) ?>" 
                                data-image="<?= !empty($newOrder['image_path']) ? 'assets/img/upload/' . $newOrder['image_path'] : '/path/to/default/image.png' ?>"
                                data-quantity="<?= htmlspecialchars($newOrder['quantity']) ?>" 
                                data-base-price-usd="<?= htmlspecialchars($newOrder['base_price_usd']) ?>"
                                data-total-price-usd="<?= htmlspecialchars($newOrder['total_price_usd']) ?>"
                                data-order-date="<?= htmlspecialchars($newOrder['order_date']) ?>" 
                                data-expected-delivery="<?= htmlspecialchars($newOrder['expected_delivery']) ?>" 
                                data-supplier="<?= htmlspecialchars($newOrder['supplier']) ?>"
                                data-brand="<?= htmlspecialchars($newOrder['brand']) ?>"
                                data-category="<?= htmlspecialchars($newOrder['category']) ?>"
                                data-model="<?= htmlspecialchars($newOrder['model']) ?>"
                                data-product-status="<?= htmlspecialchars($newOrder['product_status']) ?>"
                                data-base-price-kh="<?= htmlspecialchars($newOrder['base_price_kh']) ?>"
                                data-total-price-kh="<?= htmlspecialchars($newOrder['total_price_kh']) ?>"

                                onclick="showProductDetails(event, this)"
                                style="cursor: pointer;">

                            
                            <td><?= htmlspecialchars($newOrder['id']) ?></td>
                            <td>
                                <div class="product-image-container">
                                    <img src="<?= !empty($newOrder['image_path']) ? 'assets/img/upload/' . $newOrder['image_path'] : '/path/to/default/image.png' ?>" 
                                        alt="Product Image" class="product-image">
                                </div>
                                <?= htmlspecialchars($newOrder['product_name']) ?>
                            </td>
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
                            <!-- Dynamic pagination will be injected here -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
</div>


<style>
 @media (min-width: 768px) and (max-width: 1024px) {
    .card-container {
        padding: 1.5rem; 
        border: 1px solid #ddd;
        border-radius: 0.5rem; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        background-color: #fff; 
        height: 100%; 
    }
}
</style>

<style>
    .product-image-container {
    background-color: #f0f0f0;  /* Light gray background */
    border-radius: 8px;        /* Rounded corners */
    padding: 2px;              /* Space around the image */
    display: inline-block;       /* Wraps around the image */
    }

    .product-image {
        width: 40px;                /* Adjust image size */
        height: 40px;               /* Adjust image size */
        /* border-radius: 8px;         Rounded corners of the image */
    }

    .table td {
        vertical-align: middle; /* Keep text vertically centered */
        text-align: left;       /* Align text to the left */
    }

    .table td:nth-child(2) {
        display: flex;          
        align-items: center;    
        justify-content: flex-start;
        border: none; /* Ensure no extra bold effect */
        font-weight: normal; /* Ensure text weight is the same */
    }


    .product-image-container {
        margin-right: 10px;     /* Space between image and text */
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
                    <!-- Left: Image & Basic Order Info -->
                    <div class="col-md-5">
                        <div class="card border-0 shadow-sm p-3">
                            <img id="modal-product-image" src="" alt="Product Image" class="img-fluid rounded mb-3" style="max-height: 250px; object-fit: cover;">
                            <p class="mb-2"><strong>Order ID:</strong> <span id="modal-order-id" class="text-primary fw-bold"></span></p>
                            <p class="mb-2"><strong>Product Name:</strong> <span id="modal-product-name" class="text-primary fw-bold"></span></p>
                        </div>
                    </div>

                    <!-- Right: Detailed Information -->
                    <div class="col-md-7 d-flex flex-column">
                        <div class="border-0 shadow-sm p-3 flex-fill">
                            <!-- Order Info Group -->
                            <p class="mb-2"><strong>Quantity:</strong> <span id="modal-quantity"></span></p>
                            <p class="mb-2"><strong>Order Date:</strong> <span id="modal-order-date"></span></p>
                            <p class="mb-2"><strong>Expected Delivery:</strong> <span id="modal-expected-delivery"></span></p>
                            <p class="mb-2"><strong>Supplier:</strong> <span id="modal-supplier"></span></p>

                            <!-- Pricing Info Group -->
                            <hr class="my-3">
                            <p class="mb-2"><strong>Base Price (USD):</strong> <span id="modal-base_price_usd"></span></p>
                            <p class="mb-2 text-danger"><strong>Total Price (USD):</strong> <span id="modal-total_price_usd"></span></p>
                            <p class="mb-2"><strong>Base Price (KHR):</strong> <span id="modal-base-price-kh"></span></p>
                            <p class="mb-2 text-danger"><strong>Total Price (KHR):</strong> <span id="modal-total-price-kh"></span></p>

                            <!-- Product Info Group -->
                            <hr class="my-3">
                            <p class="mb-2"><strong>Brand:</strong> <span id="modal-brand"></span></p>
                            <p class="mb-2"><strong>Category ID:</strong> <span id="modal-category"></span></p>
                            <p class="mb-2"><strong>Model:</strong> <span id="modal-model"></span></p>
                            <p class="mb-2"><strong>Status:</strong> <span id="modal-product-status"></span></p>
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

<!-- JavaScript -->
<script>
function showProductDetails(event, row) {
    if (event.target.closest(".dropdown") || event.target.closest("button") || event.target.closest("a")) {
        return;
    }

    // Existing fields
    document.getElementById("modal-order-id").textContent = row.dataset.id;
    document.getElementById("modal-product-name").textContent = row.dataset.productName;
    document.getElementById("modal-quantity").textContent = row.dataset.quantity;
    document.getElementById("modal-order-date").textContent = row.dataset.orderDate;
    document.getElementById("modal-expected-delivery").textContent = row.dataset.expectedDelivery;
    document.getElementById("modal-supplier").textContent = row.dataset.supplier;
    document.getElementById("modal-base_price_usd").textContent = row.dataset.basePriceUsd;
    document.getElementById("modal-total_price_usd").textContent = row.dataset.totalPriceUsd;
    document.getElementById("modal-product-image").src = row.dataset.image;

    // New hidden fields
    document.getElementById("modal-brand").textContent = row.dataset.brand || 'N/A';
    document.getElementById("modal-category").textContent = row.dataset.category || 'N/A';
    document.getElementById("modal-model").textContent = row.dataset.model || 'N/A';
    document.getElementById("modal-product-status").textContent = row.dataset.productStatus || 'N/A';
    document.getElementById("modal-base-price-kh").textContent = row.dataset.basePriceKh || '0';
    document.getElementById("modal-total-price-kh").textContent = row.dataset.totalPriceKh || '0';

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
    modal.show();
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


<!-- Export excel and pdf -->
<script>
    async function exportToExcel() {
        const table = document.getElementById("orderTable");
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet("Orders");

        // Extract headers while ignoring the last "Action" column
        const headers = [];
        table.querySelectorAll("thead tr th").forEach((th, index, arr) => {
            if (index !== arr.length - 1) headers.push(th.innerText);
        });

        // Apply styles to headers
        worksheet.addRow(headers).eachCell((cell) => {
            cell.font = { bold: true, color: { argb: "FFFFFFFF" } }; 
            cell.fill = { type: "pattern", pattern: "solid", fgColor: { argb: "4F81BD" } }; 
            cell.alignment = { horizontal: "center", vertical: "middle" };
            cell.border = { bottom: { style: "thin" } };
        });

        // Extract and style table data while ignoring the "Action" column
        const rows = [];
        table.querySelectorAll("tbody tr").forEach((row, rowIndex) => {
            const rowData = [];
            row.querySelectorAll("td").forEach((cell, cellIndex, arr) => {
                if (cellIndex !== arr.length - 1) rowData.push(cell.innerText);
            });
            const addedRow = worksheet.addRow(rowData);

            // Alternate row colors for better readability
            if (rowIndex % 2 !== 0) {
                addedRow.eachCell((cell) => {
                    cell.fill = { type: "pattern", pattern: "solid", fgColor: { argb: "F2F2F2" } }; 
                });
            }

            // Add borders to all cells
            addedRow.eachCell((cell) => {
                cell.border = {
                    top: { style: "thin" },
                    bottom: { style: "thin" },
                    left: { style: "thin" },
                    right: { style: "thin" }
                };
            });
        });

        // Auto-size columns
        worksheet.columns.forEach((column) => {
            column.width = 20;
        });

        // Create and download the Excel file
        const buffer = await workbook.xlsx.writeBuffer();
        const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "orders.xlsx";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    document.querySelector("button[name='export_excel']").addEventListener("click", function (event) {
        event.preventDefault();
        exportToExcel();
    });
</script>

<!-- export to pdf -->
<script>
    async function exportToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add Store Name and Description at the top of the PDF
        const storeName = "Here you can find the best products and services.";
        const storeDescription = "Order Product List";
        const title = "Heng Heng";

        // Set title
        doc.setFontSize(16);
        doc.setFont("helvetica", "bold");
        doc.text(title, 14, 20);  // Add title with larger font size

        // Set store name and description
        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.text(storeName, 14, 30);
        doc.text(storeDescription, 14, 36);

        // Add a line break before table
        doc.line(14, 40, 200, 40);  // Line separating title and table

        const table = document.getElementById("orderTable");
        const rows = [];
        const headers = [];
        
        // Extract headers while ignoring "Action" column
        const headerCells = table.querySelectorAll("thead tr th");
        headerCells.forEach((th, index, arr) => {
            if (index !== arr.length - 1) headers.push(th.innerText);
        });

        // Extract table rows while ignoring the "Action" column
        table.querySelectorAll("tbody tr").forEach(row => {
            const rowData = [];
            const cells = row.querySelectorAll("td");
            cells.forEach((cell, index, arr) => {
                if (index !== arr.length - 1) rowData.push(cell.innerText);
            });
            rows.push(rowData);
        });

        // Define column styles and colors
        const columnStyles = {};
        const statusIndex = headers.findIndex((h) => h.toLowerCase().includes("status"));

        rows.forEach((row, index) => {
            const status = row[statusIndex]?.toLowerCase() || "";
            let bgColor = ""; // Default no background

            if (status.includes("completed")) bgColor = "#c6efce"; 
            else if (status.includes("pending")) bgColor = "#fff2cc"; 
            else if (status.includes("canceled")) bgColor = "#f4cccc"; 
            else if (index % 2 !== 0) bgColor = "#f2f2f2"; 

            if (bgColor) {
                columnStyles[index] = { fillColor: bgColor };
            }
        });

        // Generate PDF table with styling
        doc.autoTable({
            head: [headers],
            body: rows,
            theme: "grid",
            startY: 45,  
            styles: {
                font: "helvetica",
                fontSize: 10,
                textColor: [0, 0, 0],
                cellPadding: 4,
            },
            headStyles: {
                fillColor: [31, 78, 120], 
                textColor: 255, 
                fontStyle: "bold",
                halign: "center",
            },
            alternateRowStyles: {
                fillColor: [242, 242, 242],
            },
            columnStyles: columnStyles,
        });

        // Save the PDF
        doc.save("orders.pdf");
    }

    document.querySelector("button[name='export_pdf']").addEventListener("click", function(event) {
        event.preventDefault();
        exportToPDF();
    });
</script>

<?php else: ?>
<?php $this->redirect('/login'); ?>
<?php endif; ?>
