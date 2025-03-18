<div class="container mt-4">
    <h1>Arrived Products</h1>
    <div class="card p-5 bg-white shadow-lg border-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Order" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
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
                        <th>Status</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id=switchTableBody>
                    <?php foreach($arrivedProducts as $arrivedProduct): ?>
                        <?php if ($arrivedProduct['expected_delivery'] === 'Arrived'): ?>
                            <tr class="border-bottom">
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
        </div>
    </div>
</div>


