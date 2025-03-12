<!-- Modal for Deleting Category -->
<div class="modal fade" id="categoryDeleteModal<?= $category['id'] ?>" tabindex="-1" aria-labelledby="categoryDeleteModalLabel<?= $category['id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryDeleteModalLabel<?= $category['id'] ?>">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the category: <?= htmlspecialchars($category['name']) ?>?
            </div>
            <div class="modal-footer">
                <form method="POST" action="/inventory/category_list/destroy">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
