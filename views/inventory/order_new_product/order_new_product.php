<div class="container mt-4">
    <h1>Order Details</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Order" style="width: 200px;">
            <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                + Add New Order
            </button>
        </div>

        <div class="mb-3">
            <label for="fileUpload" class="form-label">Upload Orders (PDF or Excel)</label>
            <input type="file" class="form-control" id="fileUpload" accept=".pdf, .xls, .xlsx">
            <button class="btn btn-success mt-2" id="uploadButton">Upload</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="orderTable">
                <thead>
                    <tr class="border-0">
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Expected Delivery</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample order entries -->
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product A</td>
                        <td>10</td>
                        <td>March 10, 2023</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="deliveryStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-2">Expected Delivery</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="deliveryStatusDropdown">
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'In Delivery')">In Delivery</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Arrived')">Arrived</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Expected Delivery')">Expected Delivery</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>Supplier X</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product A</td>
                        <td>10</td>
                        <td>March 10, 2023</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="deliveryStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-2">In Delivery</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="deliveryStatusDropdown">
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'In Delivery')">In Delivery</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Arrived')">Arrived</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Expected Delivery')">Expected Delivery</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>Supplier X</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product A</td>
                        <td>10</td>
                        <td>March 10, 2023</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="deliveryStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-2">Expected Delivery</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="deliveryStatusDropdown">
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'In Delivery')">In Delivery</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Arrived')">Arrived</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Expected Delivery')">Expected Delivery</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>Supplier X</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product A</td>
                        <td>10</td>
                        <td>March 10, 2023</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="deliveryStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-2">Expected Delivery</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="deliveryStatusDropdown">
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'In Delivery')">In Delivery</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Arrived')">Arrived</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateDeliveryStatus(this, 'Expected Delivery')">Expected Delivery</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>Supplier X</td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <!-- Additional rows can be added here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Adding New Order -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newOrderForm">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="orderDate" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="orderDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="expectedDelivery" class="form-label">Expected Delivery</label>
                        <select class="form-select" id="expectedDelivery" required>
                            <option value="In Delivery">In Delivery</option>
                            <option value="Arrived">Arrived</option>
                            <option value="Expected Delivery">Expected Delivery</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" id="supplier" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addOrderButton">Add Order</button>
            </div>
        </div>
    </div>
</div>
