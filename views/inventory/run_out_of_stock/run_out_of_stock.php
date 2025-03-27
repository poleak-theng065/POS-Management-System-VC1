<?php session_start(); ?> 
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>
<div class="container mt-4">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block" 
        style="border-left: 8px solid #dc3545; background-color: #f8f9fa;">
        <i class="bi bi-exclamation-circle-fill text-danger me-2"></i> Products Currently Out of Stock
    </h1>


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
            <div id="entryInfo">
                Showing <span id="startEntry">1</span> to <span id="endEntry">3</span> of <span id="totalEntries">3</span> entries
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
        <div class="d-flex justify-content-start mt-3">
            <a href="/product_list" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<?php else: ?>
<?php $this->redirect('/login'); ?>
<?php endif; ?>