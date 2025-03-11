<style>
    body {
        background-color: #f8f9fa;
    }
    .container {
        margin-top: 30px;
    }
    .card {
        border: none;
        border-radius: 10px;
        padding: 20px;
    }
    .table th {
        background-color: #ffffff;
        border-bottom: 1px solid #dee2e6;
    }
    .table td {
        border-bottom: 1px solid #dee2e6;
    }
    .action-btn {
        border: none;
        background: none;
        padding: 0;
        font-size: 1.2rem;
        cursor: pointer;
    }
    .category-image {
        width: 40px;
        height: 40px;
        border-radius: 5px;
    }
</style>

<?php
require_once 'views/layouts/header.php';
require_once 'views/layouts/navbar.php';
?>

<div class="container mt-4">
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control w-25" placeholder="Search Category">
            <div class="d-flex align-items-center">
                <select class="form-select w-auto me-2">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <a href="/add" class="btn btn-primary">+ Add Category</a>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="7">No categories found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($categories as $index => $category): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($category['Category_Name']) ?></td>
                            <td><?= htmlspecialchars($category['Quantity_Product']) ?></td>
                            <td><?= htmlspecialchars($category['Model_Product']) ?></td>
                            <td><?= htmlspecialchars($category['Type_Product']) ?></td>
                            <td><?= htmlspecialchars($category['Sell_Price']) ?></td>
                            <td>
                                <a href="/categories/edit?id=<?= $category['Category_ID'] ?>" class="btn btn-warning">Edit</a> |
                                
                                <!-- Delete Button and Modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#categoryDeleteModal<?= $category['Category_ID'] ?>">
                                    Delete
                                </button>

                                <!-- Delete Category Modal -->
                                <div class="modal fade" id="categoryDeleteModal<?= $category['Category_ID'] ?>" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="categoryDeleteLabel">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the category: <?= htmlspecialchars($category['Category_Name']) ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="/categories/delete?id=<?= $category['Category_ID'] ?>" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                | <a href="/categories/show?id=<?= $category['Category_ID'] ?>" class="btn btn-success">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>
