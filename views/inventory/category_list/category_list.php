<div class="container mt-4">
    <h1>Product Cateory List</h1>
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control w-25" placeholder="Search Category">
            <div class="d-flex align-items-center">
                <select class="form-select w-auto me-2" id="entriesPerPage">
                    <option value="2">2</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                </select>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ Add Category</button>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="categoriesTable">
                <?php foreach ($categories as $index => $category): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= !empty($category['brand']) ? $category['brand'] : 'No Brand' ?></td>
                        <td><?= !empty($category['model']) ? $category['model'] : 'No Model' ?></td>
                        <td><?= !empty($category['type']) ? $category['type'] : 'No Type' ?></td>
                        <td><?= !empty($category['stock_quantity']) ? $category['stock_quantity'] : 'No Quantity' ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <a class="text-warning me-2 editCategoryBtn"
                                data-id="<?= $category['category_id'] ?>"
                                data-name="<?= htmlspecialchars($category['name']) ?>"
                                data-description="<?= htmlspecialchars($category['description']) ?>"
                                data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                <i class="bi bi-pencil-square fs-4"></i>
                            </a>

                            <a type="button" class="text-danger deleteCategoryBtn"
                                data-id="<?= $category['category_id'] ?>"
                                data-name="<?= htmlspecialchars($category['name']) ?>"
                                data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                <i class="bi bi-trash fs-4"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>


            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entriesInfo">
                Showing 1 to 2 of 5 entries
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


<!-- Modal for Adding Category -->
<form action="/inventory/category_list/store" method="POST">
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter category description" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal for Editing Category -->
<form action="/inventory/category_list/update" method="POST">
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add hidden field for Category_ID -->
                    <input type="hidden" name="category_id" id="category-id"> <!-- Changed to category_id -->
                    <div class="form-group">
                        <label for="edit-name">Category Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="edit-description">Category Description</label>
                        <input type="text" class="form-control" id="edit-description" name="description" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.querySelectorAll('.editCategoryBtn').forEach(button => {
        button.addEventListener('click', function() {
            // Get data attributes from the button
            const categoryId = this.getAttribute('data-id');
            const categoryName = this.getAttribute('data-name');
            const categoryDescription = this.getAttribute('data-description');

            // Set the values in the modal form fields
            document.getElementById('edit-name').value = categoryName;
            document.getElementById('edit-description').value = categoryDescription;

            // Set the hidden Category_ID field value
            document.getElementById('category-id').value = categoryId;

            // Update the form action dynamically with the category ID
            const formAction = '/inventory/category_list/update'; // No need to include ID here since it's a POST request
            document.querySelector('form[action^="/inventory/category_list/update"]').action = formAction;
        });
    });
</script>

<!-- Delete Modal (Single Modal for All Categories) -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteCategoryName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteCategoryForm" method="POST" action="/inventory/category_list/destroy/<?= $category['category_id'] ?>">
                    <input type="hidden" name="category_id" id="deleteCategoryId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".deleteCategoryBtn").forEach(button => {
        button.addEventListener("click", function() {
            let categoryId = this.getAttribute("data-id");
            document.getElementById("deleteCategoryId").value = categoryId;
        });
    });
</script>