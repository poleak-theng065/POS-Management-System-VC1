
<!-- Modal for Deleting Category -->
 
<div class="modal fade" id="categoryDeleteModal<?= $category['Category_ID'] ?>" tabindex="-1" aria-labelledby="categoryDeleteModalLabel<?= $category['Category_ID'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryDeleteModalLabel<?= $category['Category_ID'] ?>">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the category: <?= htmlspecialchars($category['Category_Name']) ?>?
            </div>
            <form method="POST" action="/category_list/destroy">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id']); ?>">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
</form>
            </div>
        </div>
    </div>
</div>
