<div class="container mt-4">
    <h1>Low Stock Product</h1>
    <div class="card p-5 bg-white shadow-lg border-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Order" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody id=switchTableBody>
                    <?php foreach ($products as $index => $product): ?>
                        <tr>
                            <td><?= $product['barcode'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['stock_quantity'] ?></td>
                            <td><?= !empty($product['category_name']) ? $product['category_name'] : 'No category' ?></td>
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