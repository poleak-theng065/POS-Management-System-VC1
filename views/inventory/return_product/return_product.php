<!-- Container for the table -->
<div class="container mt-4">
    <h1>Returned Product</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Product" style="width: 200px;">
            <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#returnModal">
                + Add Return
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
            <thead>
                <tr class="border-0">
                    <th><input type="checkbox" class="form-check-input"></th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Reason for Return</th>
                    <th>Return Date</th>
                    <th>Type of Return</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                    <!-- Sample returned product entries -->
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product A</td>
                        <td>5</td>
                        <td>Defective Item</td>
                        <td>March 10, 2023</td>
                        <td><span class="badge bg-success">Good Return</span></td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product B</td>
                        <td>3</td>
                        <td>Wrong Item Sent</td>
                        <td>March 12, 2023</td>
                        <td><span class="badge bg-danger">Damaged Return</span></td>
                        <td><span class="badge bg-warning">Pending</span></td>
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

    <!-- Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="returnModalLabel">Return Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="returnForm">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason for Return</label>
                            <textarea class="form-control" id="reason" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="returnType" class="form-label">Type of Return</label>
                            <select class="form-select" id="returnType" required>
                                <option value="" disabled selected>Select Type of Return</option>
                                <option value="Good Return">Good Return</option>
                                <option value="Damaged Return">Damaged Return</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="returnDate" class="form-label">Return Date</label>
                            <input type="date" class="form-control" id="returnDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Return</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

