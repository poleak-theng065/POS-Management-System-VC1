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

    <h1>Product List</h1>
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
                <a href="/import_product" class="btn btn-primary rounded-3 d-inline-block">+ Add Product</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Status</th>
                        <!-- <th>Category</th>
                        <th>Model</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $index => $product): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['code'] ?></td>
                            <td><?= $product['status'] ?></td>
                            <td>
                                <a href="/product/edit?id=<?= $product['id'] ?>" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                                <a type="button" class="text-danger" data-bs-toggle="modal" data-bs-target="#product<?= $product['id'] ?>">
                                    <i class="bi bi-trash fs-4"></i>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach ?>
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