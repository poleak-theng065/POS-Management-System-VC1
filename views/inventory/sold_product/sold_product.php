<style>
        th.sortable {
            cursor: pointer;
        }

        th.sortable:hover span {
            visibility: visible; /* Show icon on hover */
        }

        th span {
            visibility: hidden; /* Hide icon normally */
            margin-left: 5px; /* Space between header text and icon */
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .category-image {
            width: 50px; /* Adjust image size */
            height: auto;
        }
    </style>

<div class="container mt-4">
    <h1>Sales List</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th onclick="sortTable('product')" class="sortable">Product <span id="productSortIcon"></span></th>
                        <th onclick="sortTable('category')" class="sortable">Category <span id="categorySortIcon"></span></th>
                        <th onclick="sortTable('qty')" class="sortable">Quantity Sold <span id="qtySortIcon"></span></th>
                        <th onclick="sortTable('earning')" class="sortable">Total Earning <span id="earningSortIcon"></span></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                                <strong style="display: block;">Travel</strong>
                            </div>
                        </td>
                        <td><span class="badge bg-danger">Shoes</span></td>
                        <td class="product-count">10</td>
                        <td class="earning">$125</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                                <div>
                                    <strong style="display: block;">Travel</strong>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-danger">Electronics</span></td>
                        <td class="product-count">5</td>
                        <td class="earning">$263.49</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <img src="https://m.media-amazon.com/images/I/618Bb+QzCmL.jpg" class="category-image me-2" alt="Travel">
                                <div>
                                    <strong style="display: block;">Travel</strong>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-danger">Electronics</span></td>
                        <td class="product-count">20</td>
                        <td class="earning">$248.39</td>
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

