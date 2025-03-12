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
                    <th>Quantity</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="categoriesTable">
                <?php foreach ($categories as $index => $category): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $category['Category_Name'] ?></td>
                        <td><?= $category['Quantity_Product'] ?></td>
                        <td><?= $category['Model_Product'] ?></td>
                        <td><?= $category['Type_Product'] ?></td>
                        <td><?= $category['Sell_Price'] ?></td>
                        <td>
                            <button class="btn btn-warning editCategoryBtn"
                                data-id="<?= $category['id'] ?>"
                                data-name="<?= htmlspecialchars($category['Category_Name']) ?>"
                                data-model="<?= htmlspecialchars($category['Quantity_Product']) ?>"
                                data-type="<?= htmlspecialchars($category['Model_Product']) ?>"
                                data-description="<?= htmlspecialchars($category['Type_Product']) ?>"
                                data-description="<?= htmlspecialchars($category['Sell_Price']) ?>"
                                data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                Edit
                            </button>
                            <td>
                                <!-- Delete Button to Trigger Modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#categoryDeleteModal<?= $category['Category_ID'] ?>">
                                    Delete
                                </button>
                            </td>
                            <!-- Modal -->
                            <?php require 'delete.php' ?>
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
                            <label for="model">Category Model</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Enter category model" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Category Type</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Enter category type" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Write a comment..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>




<!-- Edit Category Modal -->
<form action="/inventory/category_list/update?id=<?= $category['id'] ?>" method="POST">
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-name">Category Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="edit-model">Quantity Category</label>
                        <input type="text" class="form-control" id="edit-model" name="model" value="">
                    </div>
                    <div class="form-group">
                        <label for="edit-type">Category Model</label>
                        <input type="text" class="form-control" id="edit-type" name="type" value="">
                    </div>
                    <div class="form-group">
                        <label for="edit-description">Category Type</label>
                        <textarea class="form-control" id="edit-description" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-price">Price</label>
                        <textarea class="form-control" id="edit-price" rows="3" name="price"></textarea>
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
            const categoryModel = this.getAttribute('data-model');
            const categoryType = this.getAttribute('data-type');
            const categoryDescription = this.getAttribute('data-description');

            // Set the values in the modal form fields
            document.getElementById('edit-name').value = categoryName;
            document.getElementById('edit-model').value = categoryModel;
            document.getElementById('edit-type').value = categoryType;
            document.getElementById('edit-description').value = categoryDescription;

            // You could also pass the category ID to the form action dynamically if needed
            const formAction = '/inventory/category_list/update?id=' + categoryId;
            document.querySelector('form[action^="/inventory/category_list/update"]').action = formAction;
        });
    });
</script>