<?php session_start(); ?> 
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>

<div class="container mt-4">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block" 
        style="border-left: 8px solid #ffc107; background-color: #f8f9fa;">
        <i class="bi bi-arrow-down-circle-fill text-warning me-2"></i> Inventory Running Low: Immediate Attention Required
    </h1>




    <div class="card p-5 bg-white shadow-lg border-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" class="form-control" placeholder="Search Order" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="orderTable">
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
                        <tbody id='switchTableBody'>
                        <?php foreach ($runOutAndLowStockProducts as $index => $product): ?>
                            <tr>
                                <td><?= $product['barcode'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['brand'] ?></td>
                                <td><?= $product['type'] ?></td>
                                <td><?= $product['status'] ?></td>
                                <td><?= $product['stock_quantity'] ?></td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <!-- Pagination Component -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div id="entriesInfo" class="text-muted">
                        Showing 1 to <?= count($runOutAndLowStockProducts) ?> of <?= count($runOutAndLowStockProducts) ?> entries
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
</div>

<?php else: ?>
<?php $this->redirect('/login'); ?>
<?php endif; ?>