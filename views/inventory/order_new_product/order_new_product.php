<div class="container mt-4">
    <h1>Order Details</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search Order..." onkeyup="searchOrder()">
        <p id="noResults" style="display: none; color: red;">No categories found.</p>
            
            <a href="/order_new_product/create" class="btn btn-primary ms-2">
                + Add New Order
            </a>
        </div>

        <div class="mb-3">
            <label for="fileUpload" class="form-label">Upload Orders (PDF or Excel)</label>
            <input type="file" class="form-control" id="fileUpload" accept=".pdf, .xls, .xlsx">
            <button class="btn btn-success mt-2" id="uploadButton">Upload</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="orderTable">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Expected Delivery</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <?php foreach($newOrders as $newOrder): ?>
                    <tr class="border-bottom">
                        <td><?= htmlspecialchars($newOrder['id']) ?></td>
                        <td><?= htmlspecialchars($newOrder['product_name']) ?></td>
                        <td><?= htmlspecialchars($newOrder['quantity']) ?></td>
                        <td><?= htmlspecialchars($newOrder['order_date']) ?></td>
                        <td>
                            <?php if ($newOrder['expected_delivery'] === 'In Delivery'): ?>
                                <span class="badge bg-info">In Delivery</span>
                            <?php elseif ($newOrder['expected_delivery'] === 'Arrived'): ?>
                                <span class="badge bg-success">Arrived</span>
                            <?php elseif ($newOrder['expected_delivery'] === 'Order'): ?>
                                <span class="badge bg-primary">Order</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= htmlspecialchars($newOrder['expected_delivery']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($newOrder['supplier']) ?></td>
                        <td>
                            <a href="/order_new_product/edit/<?= $newOrder['id'] ?>" class="text-warning me-2">
                                <i class="bi bi-pencil-square fs-4"></i>
                            </a>
                            <a href="/order_new_product/delete/<?= $newOrder['id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this order?');">
                                <i class="bi bi-trash fs-4"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function searchOrders() {
    // Get the search input value
    const input = document.getElementById("searchOrderInput").value.toLowerCase().trim();
    const tableBody = document.getElementById("orderTableBody");
    const rows = tableBody.getElementsByTagName("tr");
    let found = false;

    // Loop through all table rows
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let rowMatch = false;

        // Loop through all cells in the current row
        for (let j = 0; j < cells.length; j++) {
            // Get the text content of the cell
            let cellText = cells[j].textContent || cells[j].innerText;
            cellText = cellText.toLowerCase();

            // Check if the search term is in this cell
            if (cellText.includes(input)) {
                rowMatch = true;
                found = true;
                break; // No need to check other cells in this row
            }
        }

        // Show or hide the row based on whether a match was found
        rows[i].style.display = rowMatch ? "" : "none";
    }

    // Optional: Add a "No results" message if needed
    // You would need to add a div with id="noResults" in your HTML
    const noResults = document.getElementById("noResults");
    if (noResults) {
        noResults.style.display = found ? "none" : "block";
    }
}
</script>