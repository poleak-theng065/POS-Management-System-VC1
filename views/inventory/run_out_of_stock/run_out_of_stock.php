<div class="container mt-4">
    <h1>Run Out Of Stock Product</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th onclick="sortTable('product')" class="sortable">Product Name <span id="productSortIcon"></span></th>
                        <th onclick="sortTable('category')" class="sortable">Category <span id="categorySortIcon"></span></th>
                        <th>Quantity in Stock</th>
                        <th>Last Restocked Date</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Product 1">
                                <strong style="display: block;">Product A</strong>
                            </div>
                        </td>
                        <td><span class="badge bg-danger">Toys</span></td>
                        <td class="product-count">0</td>
                        <td>March 1, 2023</td>
                        <td>Supplier X</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Product 2">
                                <strong style="display: block;">Product B</strong>
                            </div>
                        </td>
                        <td><span class="badge bg-danger">Electronics</span></td>
                        <td class="product-count">0</td>
                        <td>February 15, 2023</td>
                        <td>Supplier Y</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Product 3">
                                <strong style="display: block;">Product C</strong>
                            </div>
                        </td>
                        <td><span class="badge bg-danger">Home Goods</span></td>
                        <td class="product-count">0</td>
                        <td>January 20, 2023</td>
                        <td>Supplier Z</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entryInfo">
                Showing <span id="startEntry">1</span> to <span id="endEntry">3</span> of <span id="totalEntries">3</span> entries
            </div>
            <nav>
                <ul class="pagination" id="pagination">
                    <li class="page-item disabled" id="prevPage">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active" id="page1">
                        <a class="page-link" href="#">1</a>
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

