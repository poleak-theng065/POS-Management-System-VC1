<div class="container mt-4">
    <!-- Everything inside a single white card -->
     <h1>Welcome to PHP</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        <!-- Filter Section -->
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

        <!-- Search and Actions -->
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

        <!-- Product Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Barcode</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="me-2 rounded" alt="Product Image" style="width: 40px; height: 40px;">
                            Air Jordan
                        </td>
                        <td><span class="badge bg-danger">Shoes</span></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>31063</td>
                        <td>$125</td>
                        <td>10</td>
                        <td><span class="badge bg-danger">Inactive</span></td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="me-2 rounded" alt="Product Image" style="width: 40px; height: 40px;">
                            Amazon Fire TV
                        </td>
                        <td><span class="badge bg-danger">Electronics</span></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>5829</td>
                        <td>$263.49</td>
                        <td>5</td>
                        <td><span class="badge bg-warning">Scheduled</span></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <img src="https://www.zdnet.com/a/img/resize/9f3fcf92f17d47c88823e7f2c0f1454ecd3e5140/2024/09/19/8da68e24-08b1-467a-9062-a90a96c1d879/dsc02198.jpg?auto=webp&fit=crop&height=900&width=1200" class="me-2 rounded" alt="Product Image" style="width: 40px; height: 40px;">
                            Apple iPad
                        </td>
                        <td><span class="badge bg-danger">Electronics</span></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </td>
                        <td>4202</td>
                        <td>$248.39</td>
                        <td>20</td>
                        <td><span class="badge bg-success">Publish</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
