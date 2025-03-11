
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
                <form action="/category/delete_category" method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $category['Category_ID'] ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
