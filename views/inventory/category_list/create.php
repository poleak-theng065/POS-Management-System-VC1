<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Create New Category</h3>
        <form action="/category_list/store" method="post">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Category Description"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Category</button>
                <a href="/category_list" type="button" class="btn btn-secondary">Discard</a>
            </div>
        </form>
    </div>
</div>