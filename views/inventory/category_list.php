
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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ Add Category</button>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" class="form-check-input"></th>
                    <th>Categories</th>
                    <th>Total Products</th>
                    <th>Total Earning</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample category rows -->
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="category-image me-2" alt="Travel">
                        Travel<br><small>Choose from a wide range of travel accessories from popular brands</small>
                    </td>
                    <td>4186</td>
                    <td>$7129.99</td>
                    <td>
                        <button class="action-btn" onclick="editCategory('Travel')"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" onclick="deleteCategory('Travel')"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="category-image me-2" alt="Travel">
                        Travel<br><small>Choose from a wide range of travel accessories from popular brands</small>
                    </td>
                    <td>4186</td>
                    <td>$7129.99</td>
                    <td>
                        <button class="action-btn" onclick="editCategory('Travel')"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" onclick="deleteCategory('Travel')"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="category-image me-2" alt="Travel">
                        Travel<br><small>Choose from a wide range of travel accessories from popular brands</small>
                    </td>
                    <td>4186</td>
                    <td>$7129.99</td>
                    <td>
                        <button class="action-btn" onclick="editCategory('Travel')"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" onclick="deleteCategory('Travel')"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="category-image me-2" alt="Travel">
                        Travel<br><small>Choose from a wide range of travel accessories from popular brands</small>
                    </td>
                    <td>4186</td>
                    <td>$7129.99</td>
                    <td>
                        <button class="action-btn" onclick="editCategory('Travel')"><i class="fas fa-edit"></i></button>
                        <button class="action-btn" onclick="deleteCategory('Travel')"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <!-- Additional rows can be added here -->
            </tbody>
        </table>
    </div>
</div>

<<!-- Modal for Adding Category -->
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


