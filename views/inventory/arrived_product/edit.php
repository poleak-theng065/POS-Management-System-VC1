<!-- Card for Editing Order -->
<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Edit Order</h3>
        <form id="editOrderForm" action="/arrived_product/update/<?= $arrivedProduct['id'] ?>" method="post">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productname" value="<?= htmlspecialchars($arrivedProduct['product_name']) ?>">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" min="1" name="quantity" value="<?= htmlspecialchars($arrivedProduct['quantity']) ?>">
            </div>
            <div class="mb-3">
                <label for="orderDate" class="form-label">Order Date</label>
                <input type="date" class="form-control" id="orderDate" name="orderdate" value="<?= htmlspecialchars($arrivedProduct['order_date']) ?>">
            </div>
            <div class="mb-3">
                <label for="expectedDelivery" class="form-label">Expected Delivery</label>
                <select class="form-select" id="expectedDelivery" name="expecteddelivery">
                    <option value="Order" <?= ($arrivedProduct['expected_delivery'] === "Order") ? 'selected' : '' ?>>Order</option>
                    <option value="In Delivery" <?= ($arrivedProduct['expected_delivery'] === "In Delivery") ? 'selected' : '' ?>>In Delivery</option>
                    <option value="Arrived" <?= ($arrivedProduct['expected_delivery'] === "Arrived") ? 'selected' : '' ?>>Arrived</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="supplier" name="supplier" value="<?= htmlspecialchars($arrivedProduct['supplier']) ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Ready" <?= ($arrivedProduct['status'] === "Ready") ? 'selected' : '' ?>>Ready</option>
                    <option value="Pending" <?= ($arrivedProduct['status'] === "Pending") ? 'selected' : '' ?>>Pending</option>
                </select>
            </div>
            <a href="javascript:history.back()" class="btn btn-secondary" style="margin-right: 10px;">Back</a>
            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>
</div>