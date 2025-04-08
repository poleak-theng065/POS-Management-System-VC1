<?php session_start(); ?> 
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>
<div class="container mt-4">
    <!-- <h1>Product Cateory List</h1> -->
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
            <div class="d-flex align-items-center">
                <!-- <select class="form-select w-auto me-2" id="entriesPerPage">
                    <option value="2">2</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                </select> -->
                <a href="/category_list/create" class="btn btn-primary ms-2">+ Add Category</a>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="switchTableBody">
                <?php foreach ($categories as $index => $category): ?>
                    <tr class="search">
                        <td><?= $index + 1 ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= !empty($category['total_brands']) ? $category['total_brands'] : 0 ?></td>
                        <td><?= !empty($category['total_stock_quantity']) ? $category['total_stock_quantity'] : 0 ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0 m-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="/category_list/edit/<?= $category['category_id'] ?>" class="dropdown-item text-warning">
                                            <i class="bi bi-pencil-square fs-4"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a type="button" class="dropdown-item text-danger deleteCategoryBtn"
                                            data-id="<?= $category['category_id'] ?>"
                                            data-name="<?= htmlspecialchars($category['name']) ?>"
                                            data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                            <i class="bi bi-trash fs-4"></i> Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entriesInfo" class="text-muted">
                Showing 1 to <?= count($categories) ?> of <?= count($categories) ?> entries
            </div>
            <nav>
                <ul class="pagination" id="pagination">
                    <li class="page-item disabled" id="prevPage">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active" aria-current="page" id="page1">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item" id="page2">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item" id="nextPage">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Back Button -->
        <div class="d-flex justify-content-start mt-3">
            <a href="/product_list" class="btn btn-secondary">Back</a>
        </div>

    </div>
</div>


<!-- Delete Modal (Single Modal for All Categories) -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteCategoryName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteCategoryForm" method="POST" action="/category_list/destroy/<?= $category['category_id'] ?>">
                    <input type="hidden" name="category_id" id="deleteCategoryId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal (Single Modal for All Categories) -->
<script>
    document.querySelectorAll(".deleteCategoryBtn").forEach(button => {
        button.addEventListener("click", function() {
            let categoryId = this.getAttribute("data-id");
            document.getElementById("deleteCategoryId").value = categoryId;
        });
    });
</script>

<!-- Alert Create Session -->
<div id="formAlertContainer" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050; width: 300px;"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const status = localStorage.getItem('formStatus');

        console.log("Retrieved formStatus:", status); // Debugging log

        if (status) {
            let alertHTML = '';
            let alertType = '';
            let alertMessage = '';

            if (status === 'success') {
                alertType = 'success';
                alertMessage = '<strong>Success!</strong> Category added successfully.';
            } else if (status === 'duplicate') {
                alertType = 'warning';
                alertMessage = '<strong>Warning!</strong> Category already exists.';
            } else if (status === 'fail') {
                alertType = 'danger';
                alertMessage = '<strong>Error!</strong> Please fill in all required fields.';
            } else {
                console.log("Unexpected status value:", status); // Log unexpected values
            }

            if (alertMessage) {
                alertHTML = `<div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${alertMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="progress mt-2">
                                <div id="progressBar" class="progress-bar bg-${alertType}" style="width: 100%; transition: width 0.1s linear;"></div>
                            </div>
                        </div>`;

                document.getElementById('formAlertContainer').innerHTML = alertHTML;

                // Start progress bar countdown
                let duration = 5;
                let current = duration;
                const progressBar = document.getElementById('progressBar');
                const interval = setInterval(() => {
                    current -= 0.1;
                    let percent = (current / duration) * 100;
                    progressBar.style.width = percent + '%';
                    if (current <= 0) {
                        clearInterval(interval);
                        progressBar.closest('.alert').remove();
                    }
                }, 100);

                // Remove status from localStorage after displaying
                localStorage.removeItem('formStatus');
            }
        }
    });
</script>

<script>
    function searchCategory() {
        // Get the search input value
        const input = document.getElementById("searchInput").value.toLowerCase();
        const table = document.getElementById("categoriesTable");
        const rows = table.getElementsByTagName("tr");
        let found = false;

        // Loop through all table rows
        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let rowMatch = false;

            // Loop through all cells in the current row
            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].textContent || cells[j].innerText;
                // Check if the search term is in any cell of this row
                if (cellText.toLowerCase().indexOf(input) > -1) {
                    rowMatch = true;
                    found = true;
                    break; // No need to check other cells in this row
                }
            }

            // Show or hide the row based on whether a match was found
            rows[i].style.display = rowMatch ? "" : "none";
        }

        // Show/hide "No categories found" message
        document.getElementById("noResults").style.display = found ? "none" : "block";
    }
</script>

<!-- Delete Alert -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const status = localStorage.getItem('deleteStatus');

        console.log("Retrieved deleteStatus:", status); // Debugging log

        if (status) {
            let alertHTML = '';
            let alertType = '';
            let alertMessage = '';

            if (status === 'success') {
                alertType = 'success';
                alertMessage = '<strong>Success!</strong> Category deleted successfully.';
            } else if (status === 'fail') {
                alertType = 'danger';
                alertMessage = '<strong>Error!</strong> Failed to delete category.';
            } else {
                console.log("Unexpected status value:", status); // Log unexpected values
            }

            if (alertMessage) {
                alertHTML = `<div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${alertMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="progress mt-2">
                                <div id="progressBar" class="progress-bar bg-${alertType}" style="width: 100%; transition: width 0.1s linear;"></div>
                            </div>
                        </div>`;

                document.getElementById('formAlertContainer').innerHTML = alertHTML;

                // Start progress bar countdown
                let duration = 5;
                let current = duration;
                const progressBar = document.getElementById('progressBar');
                const interval = setInterval(() => {
                    current -= 0.1;
                    let percent = (current / duration) * 100;
                    progressBar.style.width = percent + '%';
                    if (current <= 0) {
                        clearInterval(interval);
                        progressBar.closest('.alert').remove();
                    }
                }, 100);

                // Remove status from localStorage after displaying
                localStorage.removeItem('deleteStatus');
            }
        }
    });
</script>
<!-- Update Alert -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const status = localStorage.getItem('updateStatus');

        console.log("Retrieved updateStatus:", status); // Debugging log

        if (status) {
            let alertHTML = '';
            let alertType = '';
            let alertMessage = '';

            if (status === 'success') {
                alertType = 'success';
                alertMessage = '<strong>Success!</strong> Category updated successfully.';
            } else if (status === 'duplicate') {
                alertType = 'warning';
                alertMessage = '<strong>Warning!</strong> Category already exists.';
            } else if (status === 'fail') {
                alertType = 'danger';
                alertMessage = '<strong>Error!</strong> Failed to update category.';
            } else {
                console.log("Unexpected status value:", status); // Log unexpected values
            }

            if (alertMessage) {
                alertHTML = `<div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${alertMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="progress mt-2">
                                <div id="progressBar" class="progress-bar bg-${alertType}" style="width: 100%; transition: width 0.1s linear;"></div>
                            </div>
                        </div>`;

                document.getElementById('formAlertContainer').innerHTML = alertHTML;

                // Start progress bar countdown
                let duration = 5;
                let current = duration;
                const progressBar = document.getElementById('progressBar');
                const interval = setInterval(() => {
                    current -= 0.1;
                    let percent = (current / duration) * 100;
                    progressBar.style.width = percent + '%';
                    if (current <= 0) {
                        clearInterval(interval);
                        progressBar.closest('.alert').remove();
                    }
                }, 100);

                // Remove status from localStorage after displaying
                localStorage.removeItem('updateStatus');
            }
        }
    });
</script>

<?php else: ?>
<?php $this->redirect('/login'); ?>
<?php endif; ?>