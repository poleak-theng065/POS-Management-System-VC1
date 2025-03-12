<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Category List</h1>

        <!-- Display success/error messages -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">Category deleted successfully!</div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="alert alert-danger">Failed to delete category.</div>
        <?php endif; ?>

        <!-- Category Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Quantity</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Sell_Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $index => $category): ?>
                        <tr>
                            <td><?= htmlspecialchars($category['Category_ID']) ?></td>
                            <td><?= htmlspecialchars($category['Category_Name']) ?></td>
                            <td><?= htmlspecialchars($category['Quantity_Product']) ?></td>
                            <td><?= htmlspecialchars($category['Model_Product']) ?></td>
                            <td><?= htmlspecialchars($category['Type_Product']) ?></td>
                            <td><?= htmlspecialchars($category['Sell_Price']) ?></td>
                            <td>
                                <!-- Delete Button to Trigger Modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#categoryDeleteModal<?= $category['Category_ID'] ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal for Deleting Category -->
                        <div class="modal fade" id="categoryDeleteModal<?= $category['Category_ID'] ?>" tabindex="-1" aria-labelledby="categoryDeleteModalLabel<?= $category['Category_ID'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="categoryDeleteModalLabel<?= $category['Category_ID'] ?>">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the category: <?= htmlspecialchars($category['Category_Name']) ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <!-- Form to delete the category -->
                                        <form action="/delete_category" method="POST" style="display: inline;">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="id" value="<?= $category['Category_ID'] ?>" id="categoryIdToDelete<?= $category['Category_ID'] ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No categories found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>