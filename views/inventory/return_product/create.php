<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Create New Order</h3>
        <form id="returnForm" action="/return_product/store" method="post">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="product_name" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
            </div>
            <div class="mb-3">
                <label for="reason" class="form-label">Reason for Return</label>
                <textarea class="form-control" id="reason" name="reason_for_return" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="returnType" class="form-label">Type of Return</label>
                <select class="form-select" id="returnType" name="type_of_return" required>
                    <option value="" disabled selected>Select Type of Return</option>
                    <option value="Good Return">Good Return</option>
                    <option value="Damaged Return">Damaged Return</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="returnDate" class="form-label">Return Date</label>
                <input type="date" class="form-control" id="returnDate" name="return_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Return</button>
        </form>
    </div>
</div>