<?php session_start(); ?> 
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>

<?php 
$totalReturns = count($returnProducts);
$goodReturns = 0;
$damagedReturns = 0;

// Loop through the products to count Good and Damaged returns
foreach ($returnProducts as $returnProduct) {
    if ($returnProduct['type_of_return'] === 'Good Return') {
        $goodReturns++;
    } elseif ($returnProduct['type_of_return'] === 'Damaged Return') {
        $damagedReturns++;
    }
}
?>

<!-- Container for the table -->
<div class="container mt-4">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block" 
        style="border-left: 8px solid #dc3545; background-color: #f8f9fa;">
        <i class="bi bi-arrow-clockwise text-danger me-2"></i> Product Return Process - Items to be Returned
    </h1>

    <div class="card p-5 bg-white shadow-lg border-0">
        <!-- Search and Filter in the Same Row -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex">
                <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
                <select id="returnFilter" class="form-select ms-2" onchange="filterReturns()" style="width: 200px;">
                    <option value="">All Returns</option>
                    <option value="Good Return">Good Return</option>
                    <option value="Damaged Return">Damaged Return</option>
                </select>
            </div>
            <a href="/return_product/create" class="btn btn-primary ms-2">+ Add Return</a>
        </div>

        <!-- Collapsible Text Section -->
        <div class="mb-3">
            <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#returnCounts" aria-expanded="false" aria-controls="returnCounts">
                <i class="bi bi-chevron-down"></i> View Return Counts
            </button>
            <div id="returnCounts" class="collapse">
                <p><strong>Total Returns:</strong> <?= $totalReturns ?></p>
                <p><strong>Good Returns:</strong> <?= $goodReturns ?></p>
                <p><strong>Damaged Returns:</strong> <?= $damagedReturns ?></p>
            </div>
        </div>



        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr class="border-0">
                        <th>Return_ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Reason for Return</th>
                        <th>Type of Return</th>
                        <th>Return Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="switchTableBody">
                    <?php foreach($returnProducts as $returnProduct): ?>
                    <tr class="border-bottom" 
                        data-return-id="<?= htmlspecialchars($returnProduct['return_id']) ?>" 
                        data-product-name="<?= htmlspecialchars($returnProduct['product_name']) ?>" 
                        data-quantity="<?= htmlspecialchars($returnProduct['quantity']) ?>" 
                        data-reason-for-return="<?= htmlspecialchars($returnProduct['reason_for_return']) ?>" 
                        data-type-of-return="<?= htmlspecialchars($returnProduct['type_of_return']) ?>" 
                        data-return-date="<?= htmlspecialchars($returnProduct['return_date']) ?>"
                        onclick="showReturnProductDetails(event)"
                        style="cursor: pointer;">
                        
                        <td><?= htmlspecialchars($returnProduct['return_id']) ?></td>
                        <td><?= htmlspecialchars($returnProduct['product_name']) ?></td>
                        <td><?= htmlspecialchars($returnProduct['quantity']) ?></td>
                        <td><?= htmlspecialchars($returnProduct['reason_for_return']) ?></td>
                        <td>
                            <?php if ($returnProduct['type_of_return'] === 'Good Return'): ?>
                                <span class="badge bg-success">Good Return</span>
                            <?php elseif ($returnProduct['type_of_return'] === 'Damaged Return'): ?>
                                <span class="badge bg-danger">Damaged Return</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= htmlspecialchars($returnProduct['type_of_return']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($returnProduct['return_date']) ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0 m-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-warning" href="/return_product/edit/<?= $returnProduct['return_id'] ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="openDeleteModal('<?= htmlspecialchars($returnProduct['product_name']) ?>', '/return_product/delete/<?= $returnProduct['return_id'] ?>')">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>



            </table>

            <!-- Pagination Component -->
            <?php 
            $currentPage = 1; // Replace with the actual current page number
            ?>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div id="entriesInfo" class="text-muted">
                    Showing 1 to <?= count($returnProducts) ?> of <?= count($returnProducts) ?> entries
                </div>
                <nav>
                    <ul class="pagination" id="pagination">
                        <li class="page-item <?= $currentPage === 1 ? 'disabled' : '' ?>" id="prevPage">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= ceil(count($returnProducts) / 5); $i++): ?>
                        <li class="page-item <?= $currentPage === $i ? 'active' : '' ?>" id="page<?= $i ?>">
                            <a class="page-link" href="#"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $currentPage === ceil(count($returnProducts) / 5) ? 'disabled' : '' ?>" id="nextPage">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailsLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Return ID:</strong> <span id="modal-return-id"></span></p>
                <p><strong>Product Name:</strong> <span id="modal-product-name"></span></p>
                <p><strong>Quantity:</strong> <span id="modal-quantity"></span></p>
                <p><strong>Reason for Return:</strong> <span id="modal-reason-for-return"></span></p>
                <p><strong>Type of Return:</strong> <span id="modal-type-of-return"></span></p>
                <p><strong>Return Date:</strong> <span id="modal-return-date"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
function showReturnProductDetails(event) {
    let target = event.target;

    // Prevent click on dropdown menu from triggering modal
    if (target.closest(".dropdown") || target.closest("button") || target.closest("a")) {
        return;
    }

    let row = target.closest("tr");
    if (row) {
        // Set modal data
        document.getElementById("modal-return-id").textContent = row.getAttribute("data-return-id");
        document.getElementById("modal-product-name").textContent = row.getAttribute("data-product-name");
        document.getElementById("modal-quantity").textContent = row.getAttribute("data-quantity");
        document.getElementById("modal-reason-for-return").textContent = row.getAttribute("data-reason-for-return");
        document.getElementById("modal-type-of-return").textContent = row.getAttribute("data-type-of-return");
        document.getElementById("modal-return-date").textContent = row.getAttribute("data-return-date");

        // Show the Bootstrap modal
        let modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
        modal.show();
    }
}
</script>




<script>
function filterReturns() {
    var filter = document.getElementById("returnFilter").value.toLowerCase();
    var rows = document.querySelectorAll("#switchTableBody tr");

    rows.forEach(function(row) {
        var typeCell = row.cells[4]; // The Type of Return column
        var typeValue = typeCell.textContent || typeCell.innerText;

        if (filter === "" || typeValue.toLowerCase().includes(filter)) {
            row.style.display = ""; // Show the row if it matches the filter
        } else {
            row.style.display = "none"; // Hide the row if it doesn't match
        }
    });
}
</script>

<!-- Modal for Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
                <p id="productName" class="fw-bold"></p> <!-- To display the product name -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
// Function to open the modal and set the product name and delete URL
function openDeleteModal(productName, deleteUrl) {
    // Set the product name in the modal
    document.getElementById('productName').textContent = productName;
    
    // Set the delete URL in the button's data attribute
    document.getElementById('confirmDeleteButton').setAttribute('data-delete-url', deleteUrl);
    
    // Show the modal
    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    myModal.show();
}

// Function to confirm the deletion
document.getElementById('confirmDeleteButton').addEventListener('click', function() {
    var deleteUrl = this.getAttribute('data-delete-url');
    window.location.href = deleteUrl; // Redirect to the delete URL
});
</script>

<?php else: ?>
    <?php $this->redirect('/login'); ?>
<?php endif; ?>