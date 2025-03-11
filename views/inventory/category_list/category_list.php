
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
                    <th><input type="checkbox" class="form-check-input"></th>
                    <th>Categories</th>
                    <th class="sortable" onclick="sortTable('products')">
                        Total Products 
                        <span id="productSortIcon" class="sort-icon"></span>
                    </th>
                    <th class="sortable" onclick="sortTable('earning')">
                        Total Earning 
                        <span id="earningSortIcon" class="sort-icon"></span>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="categoriesTable">
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <div style="display: flex; align-items: flex-start;">
                            <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                            <div>
                                <strong style="display: block;">Travel</strong>
                                <small style="display: block;">popular</small>
                            </div>
                        </div>
                    </td>
                    <td class="product-count">4186</td>
                    <td class="earning">$7129.99</td>
                    <td>
                        <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                        <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <div style="display: flex; align-items: flex-start;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                                <div>
                                    <strong style="display: block;">Travel</strong>
                                    <small style="display: block;">popular</small>
                                </div>
                        </div>
                    </td>
                    <td class="product-count">2500</td>
                    <td class="earning">$9912.99</td>
                    <td>
                        <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                        <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <div style="display: flex; align-items: flex-start;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                                <div>
                                    <strong style="display: block;">Travel</strong>
                                    <small style="display: block;">popular</small>
                                </div>
                        </div>
                    </td>
                    <td class="product-count">3000</td>
                    <td class="earning">$15000.00</td>
                    <td>
                        <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                        <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <div style="display: flex; align-items: flex-start;">
                            <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                            <div>
                                <strong style="display: block;">Travel</strong>
                                <small style="display: block;">popular</small>
                            </div>
                        </div>
                    </td>
                    <td class="product-count">1200</td>
                    <td class="earning">$5000.00</td>
                    <td>
                        <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                        <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <div style="display: flex; align-items: flex-start;">
                            <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                            <div>
                                <strong style="display: block;">Travel</strong>
                                <small style="display: block;">popular</small>
                            </div>
                        </div>
                    </td>
                    <td class="product-count">600</td>
                    <td class="earning">$3000.00</td>
                    <td>
                        <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                        <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                    </td>
                </tr>
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

