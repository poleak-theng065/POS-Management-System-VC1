<div class="container mt-4">
    <h1>Order Details</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
            <a href="/order_new_product/create" class="btn btn-primary ms-2">
                + Add New Order
            </a>
        </div>

        <div class="mb-3">
            <label for="fileUpload" class="form-label">Upload Orders (PDF or Excel)</label>
            <input type="file" class="form-control" id="fileUpload" accept=".pdf, .xls, .xlsx">
            <button class="btn btn-success mt-2" id="uploadButton">Upload</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="orderTable">
                <thead class="table-primary">
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
                    <tr class="border-bottom">
                        <td><?= htmlspecialchars($newOrder['id']) ?></td>
                        <td><?= htmlspecialchars($newOrder['product_name']) ?></td>
                        <td><?= htmlspecialchars($newOrder['quantity']) ?></td>
                        <td><?= htmlspecialchars($newOrder['order_date']) ?></td>
                        <td>
                            <?php if ($newOrder['expected_delivery'] === 'In Delivery'): ?>
                                <span class="badge bg-info">In Delivery</span>
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
                            <a href="/order_new_product/edit/<?= $newOrder['id'] ?>" class="text-warning me-2">
                                <i class="bi bi-pencil-square fs-4"></i>
                            </a>
                            <a href="/order_new_product/delete/<?= $newOrder['id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this order?');">
                                <i class="bi bi-trash fs-4"></i>
                            </a>
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

