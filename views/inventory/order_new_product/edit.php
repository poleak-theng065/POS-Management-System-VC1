<!-- Card for Editing Order -->
<div class="container mt-4">
    <div class="card p-4 bg-light shadow-sm border-0">
        <h3 class="card-title">Edit Order</h3>
        <form id="editOrderForm" action="/order_new_product/update/<?= $newOrder['id'] ?>" method="post">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productname" value="<?= htmlspecialchars($newOrder['product_name']) ?>">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" min="1" name="quantity" value="<?= htmlspecialchars($newOrder['quantity']) ?>">
            </div>
            <div class="mb-3">
                <label for="orderDate" class="form-label">Order Date</label>
                <input type="date" class="form-control" id="orderDate" name="orderdate" value="<?= htmlspecialchars($newOrder['order_date']) ?>">
            </div>
            <div class="mb-3">
                <label for="expectedDelivery" class="form-label">Expected Delivery</label>
                <select class="form-select" id="expectedDelivery" name="expecteddelivery">
                    <option value="Order" <?= ($newOrder['expected_delivery'] == "Order") ? 'selected' : '' ?>>Order</option>
                    <option value="Delivery" <?= ($newOrder['expected_delivery'] == "Delivery") ? 'selected' : '' ?>>Delivery</option>
                    <option value="Arrived" <?= ($newOrder['expected_delivery'] == "Arrived") ? 'selected' : '' ?>>Arrived</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="supplier" name="supplier" value="<?= htmlspecialchars($newOrder['supplier']) ?>">
            </div>
            <a href="javascript:history.back()" class="btn btn-secondary" style="margin-right: 10px;">Back</a>
            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>
</div>