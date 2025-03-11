
    <div class="container mt-4">
        <h1>Product Category List</h1>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Laptop</td>
                        <td>100</td>
                        <td>Apple</td>
                        <td>Computer</td>
                        <td>1000.00</td>
                        <td>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#categoryDeleteModal" data-category-id="1">Delete</button>
                            <a href="#" class="btn btn-success">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Smart Phone</td>
                        <td>23</td>
                        <td>Iphone 7</td>
                        <td>Old</td>
                        <td>150.00</td>
                        <td>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#categoryDeleteModal" data-category-id="2">Delete</button>
                            <a href="#" class="btn btn-success">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="categoryDeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this category? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="deleteCategoryButton" href="#" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>

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

    <script>
        $('#categoryDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var categoryId = button.data('category-id'); // Extract category ID from data-* attributes
            
            // Set the delete link to the appropriate URL
            var deleteUrl = '/categories/delete?id=' + categoryId; // Update this to your delete URL
            $('#deleteCategoryButton').attr('href', deleteUrl);
        });
    </script>



<!-- Modal for Adding Category -->
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
                        <label for="categoryTitle">Title</label>
                        <input type="text" class="form-control" id="categoryTitle" placeholder="Enter category title" required>
                    </div>
                    <div class="form-group">
                        <label for="categorySlug">Slug</label>
                        <input type="text" class="form-control" id="categorySlug" placeholder="Enter slug" required>
                        <small id="slugError" class="text-danger" style="display: none;">This slug already exists.</small>
                    </div>
                    <div class="form-group">
                        <label for="categoryAttachment">Attachment</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="categoryAttachment" required>
                            <label class="custom-file-label" for="categoryAttachment">Choose File</label>
                        </div>
                        <div id="fileName" class="text-muted">No file chosen</div>
                    </div>
                    <div class="form-group">
                        <label for="parentCategory">Parent category</label>
                        <select class="form-control custom-select" id="parentCategory" required>
                            <option value="" disabled selected>Select parent category</option>
                            <option>Category 1</option>
                            <option>Category 2</option>
                            <option>Category 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">Description</label>
                        <textarea class="form-control" id="categoryDescription" rows="3" placeholder="Write a comment..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoryStatus">Select category status</label>
                        <select class="form-control custom-select" id="categoryStatus" required>
                            <option value="" disabled selected>Select category status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                </form>
            </div>
        </div>
    </div>
</div>

