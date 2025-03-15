<!-- Simple Form for Adding New Order -->
<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Create New Order</h3>
        <form id="newOrderForm" action="/order_new_product/store" method="post">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productname" required name='productname'>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" required min="1" name='quantity'>
            </div>
            <div class="mb-3">
                <label for="orderDate" class="form-label">Order Date</label>
                <input type="date" class="form-control" id="orderdate" required name='orderdate'>
            </div>
            <div class="mb-3">
                <label for="expectedDelivery" class="form-label">Expected Delivery</label>
                <select class="form-select" id="expectedDelivery" required name='expecteddelivery'>

                    <option value="Expected Delivery">Expected Delivery</option>
                    <option value="Order">Order</option>
                    <option value="In Delivery">In Delivery</option>
                    <option value="Arrived">Arrived</option>
                    
                </select>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="supplier" required name='supplier'>
            </div>
            <a href="javascript:history.back()" class="btn btn-secondary" style="margin-right: 10px;">Back</a>
            <button type="submit" class="btn btn-primary">Add Order</button>
        </form>
    </div>
</div>