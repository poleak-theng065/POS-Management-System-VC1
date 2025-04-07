<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Create New Order</h3>
        <form id="returnForm" action="/return_product/store" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="product_name" required>
            </div>
            <!-- <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="productImage" name="product_image" accept="image/*" required>
            </div> -->
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
            <a href="javascript:history.back()" class="btn btn-secondary" style="margin-right: 10px;">Back</a>
            <button type="submit" class="btn btn-primary">Submit Return</button>
        </form>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get today's date in YYYY-MM-DD format
        let today = new Date().toISOString().split('T')[0];
        
        // Set the return date input field to today's date
        document.getElementById('returnDate').value = today;
    });
</script>
