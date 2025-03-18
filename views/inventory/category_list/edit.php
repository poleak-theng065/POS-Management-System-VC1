
<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Edit Category</h3>
        <form action="/category_list/update/<?= $category['category_id'] ?>" method="post">
            <input type="hidden" name="category_id" id="category-id">
            <div class="form-group">
                <label for="edit-name">Category Name</label>
                <input type="text" class="form-control" id="edit-name" name="name" value="<?= $category['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="edit-description">Description</label>
                <textarea class="form-control" id="edit-description" name="description" rows="3"><?= $category['description'] ?></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="/category_list" type="button" class="btn btn-secondary">Discard</a>
            </div>
        </form>
    </div>
</div>