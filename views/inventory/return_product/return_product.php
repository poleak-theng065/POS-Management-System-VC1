<!-- Container for the table -->
<div class="container mt-4">
    <h1>Returned Product</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
            <a href="/return_product/create" class="btn btn-primary ms-2">
                + Add Return
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr class="border-0">
                        <th>Return_ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Reason for Return</th>
                        <th>Type of Return</th>
                        <th>Return Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <?php foreach($returnProducts as $returnProduct): ?>
                    <tr class="border-bottom">
                        <td><?= htmlspecialchars($returnProduct['return_id']) ?></td>
                        <td><?= htmlspecialchars($returnProduct['product_name']) ?></td>
                        <td><?= htmlspecialchars($returnProduct['quantity']) ?></td>
                        <td><?= htmlspecialchars($returnProduct['reason_for_return']) ?></td>
                        <td>
                            <?php if ($returnProduct['type_of_return'] === 'Good Return'): ?>
                                <span class="badge bg-success">Good Return</span>
                            <?php elseif ($returnProduct['type_of_return'] === 'Damaged Return'): ?>
                                <span class="badge bg-danger">Damaged Return</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= htmlspecialchars($returnProduct['type_of_return']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($returnProduct['return_date']) ?></td>
                        <td>
                            <a href="/return_product/edit/<?= $returnProduct['return_id'] ?>" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="/return_product/delete/<?= $returnProduct['return_id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this return?');">
                                <i class="bi bi-trash fs-4"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>