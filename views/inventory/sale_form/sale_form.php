
    <style>
        body {
            background-color: #f8f9fa;
            padding: 15px;
        }
        .card {
            border-radius: 6px;
            margin-bottom: 10px;
            padding: 15px;
        }
        .section-title {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .form-control,
        .form-select {
            font-size: 14px;
            padding: 6px;
        }
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }
        .btn {
            font-size: 16px;
            padding: 10px 18px;
            border-radius: 5px;
            width: 160px;
        }
    </style>

    <div class="container">
        <h5 class="text-center mb-3">Sales Form</h5>
        <form>
            <div class="row">
                <!-- Customer Information -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="section-title">Customer Information</div>
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control mb-2" required>
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" required>
                        <label class="form-label">Email</label>
                        <input type="tel" class="form-control" required>
                    </div>
                </div>
                
                <!-- Product Selection -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="section-title">Product Selection</div>
                        <label class="form-label">Category</label>
                        <select class="form-select mb-2" required>
                            <option value="">Select category</option>
                            <option>Mobile Phone</option>
                            <option>Accessory</option>
                        </select>
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control mb-2" required>
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" min="1" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sale Details -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="section-title">Sale Details</div>
                        <label class="form-label">Price per Unit</label>
                        <input type="number" class="form-control mb-2" required>
                        <label class="form-label">Discount</label>
                        <input type="number" class="form-control" required>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="section-title">Payment Information</div>
                        <label class="form-label">Payment Method</label>
                        <select class="form-select mb-2" required>
                            <option value="">Select method</option>
                            <option>Credit Card</option>
                            <option>Cash</option>
                        </select>
                        <label class="form-label">Amount Paid</label>
                        <input type="number" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Additional Details -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="section-title">Additional Details</div>
                        <label class="form-label">Sale Date</label>
                        <input type="date" class="form-control mb-2" required>
                        <label class="form-label">Salesperson Name</label>
                        <input type="text" class="form-control" required>
                    </div>
                </div>
            </div>

            <!-- Improved Buttons -->
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Submit Sale</button>
                <button type="reset" class="btn btn-outline-secondary">Clear Form</button>
            </div>
        </form>
    </div>
