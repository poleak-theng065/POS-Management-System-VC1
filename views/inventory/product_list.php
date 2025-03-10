<div class="container mt-4">
    <div class="row text-center">
        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-store fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-up fa-lg"></i></div>
                </div>
                <h5 class="h6">In-store Sales</h5>
                <div class="value" style="font-size: 1.5rem;">$3,345.43</div>
                <div class="orders" style="font-size: 0.9rem;">50 orders <span class="increase">+57%</span></div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-shopping-cart fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-up fa-lg"></i></div>
                </div>
                <h5 class="h6">Website Sales</h5>
                <div class="value" style="font-size: 1.5rem;">$674,341.12</div>
                <div class="orders" style="font-size: 0.9rem;">21 orders <span class="increase">+12%</span></div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-percent fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-down fa-lg"></i></div>
                </div>
                <h5 class="h6">Discount</h5>
                <div class="value" style="font-size: 1.5rem;">$14,263.12</div>
                <div class="orders" style="font-size: 0.9rem;">60 orders <span class="decrease">-3%</span></div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-left"><i class="fas fa-user-friends fa-lg"></i></div>
                    <div class="icon-right"><i class="fas fa-arrow-down fa-lg"></i></div>
                </div>
                <h5 class="h6">Affiliate</h5>
                <div class="value" style="font-size: 1.5rem;">$8,345.23</div>
                <div class="orders" style="font-size: 0.9rem;">150 orders <span class="decrease">-5%</span></div>
            </div>
        </div>
    </div>

    <div class="card p-5 bg-white shadow-lg border-0">
        <h5 class="mb-4 text-primary">Filter</h5>
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                    <option>Scheduled</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Category</option>
                    <option>Electronics</option>
                    <option>Household</option>
                    <option>Shoes</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Stock</option>
                    <option>In Stock</option>
                    <option>Out of Stock</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 pt-4 pb-4 border-top border-bottom border-light py-2">
            <input type="text" class="form-control w-25" placeholder="Search Product" style="border-radius: 10px;">
            <div class="d-flex align-items-center">
                <select class="form-select w-auto me-3" style="border-radius: 10px;">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
                <button class="btn btn-outline-secondary me-3" disabled>Export</button>
                <a href="/create" class="btn btn-primary rounded-3 d-inline-block">+ Add Product</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th onclick="sortTable('product')" class="sortable">Product <span id="productSortIcon"></span></th>
                        <th onclick="sortTable('category')" class="sortable">Category <span id="categorySortIcon"></span></th>
                        <th onclick="sortTable('stock')" class="sortable">Stock <span id="stockSortIcon"></span></th>
                        <th onclick="sortTable('sku')" class="sortable">SKU <span id="skuSortIcon"></span></th>
                        <th onclick="sortTable('earning')" class="sortable">Earning <span id="earningSortIcon"></span></th>
                        <th onclick="sortTable('qty')" class="sortable">QTY <span id="qtySortIcon"></span></th>
                        <th onclick="sortTable('status')" class="sortable">Status <span id="statusSortIcon"></span></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-bottom">
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
                        <td><span class="badge bg-danger">Shoes</span></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>31063</td>
                        <td class="earning">$125</td>
                        <td class="product-count">10</td>
                        <td><span class="badge bg-danger">Inactive</span></td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
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
                        <td><span class="badge bg-danger">Electronics</span></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>5829</td>
                        <td class="earning">$263.49</td>
                        <td class="product-count">5</td>
                        <td><span class="badge bg-warning">Scheduled</span></td>
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
                        <td><span class="badge bg-danger">Electronics</span></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>4202</td>
                        <td class="earning">$248.39</td>
                        <td class="product-count">20</td>
                        <td><span class="badge bg-success">Publish</span></td>
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