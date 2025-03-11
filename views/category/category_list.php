<div class="container mt-4">
    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control w-25" placeholder="Search Category">
            <div class="d-flex align-items-center">
                <select class="form-select w-auto me-2" id="entriesPerPage">
                    <option value="2">2</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                </select>
                <a href="/category/create" class="btn btn-primary">+ Add Category</a>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="categoriesTable">
                <?php foreach ($categories as $index => $category): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['model'] ?></td>
                        <td><?= $category['type'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-warning edit-btn" data-category-id="<?= $category['id'] ?>" data-category-name="<?= $category['name'] ?>" data-category-model="<?= $category['model'] ?>" data-category-type="<?= $category['type'] ?>" data-category-description="<?= $category['description'] ?>">Edit</a>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#category<?= $category['id'] ?>">
                                delete
                            </button>

                            <!-- Modal -->
                            <?php require 'delete.php' ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entriesInfo">
                Showing 1 to 2 of 5 entries
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


    </div>

    <form id="editCategoryForm" action="/category/update?id=<?= $category['id'] ?>" method="POST" style="display: none;">
        <div id="slugErrorEdit" class="alert alert-danger" style="display: none;">
            <!-- Category Name -->
            <div class="form-section mb-4 p-4 border rounded bg-white shadow-sm">
                <h5 class="mb-3">Category Information</h5>
                <div class="mb-3">
                    <label for="productName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="productName" name="name">
                </div>
                <div class="row">
                    <!-- Model -->
                    <div class="col-md-6 mb-3">
                        <label for="sku" class="form-label">Model</label>
                        <input type="text" class="form-control" id="sku" name="model">
                    </div>
                    <!-- Type -->
                    <div class="col-md-6 mb-3">
                        <label for="barcode" class="form-label">Type</label>
                        <input type="text" class="form-control" id="barcode" name="type">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                </div>
            </div>

            <!-- Slug Validation Error -->
            <div id="slugErrorEdit" class="alert alert-danger" style="display: none;">
                This slug is already taken. Please choose a different one.
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-3">Update Category</button>
            </div>
        </div>
    </form>



</div>


<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');
            const categoryName = this.getAttribute('data-category-name');
            const categoryModel = this.getAttribute('data-category-model');
            const categoryType = this.getAttribute('data-category-type');
            const categoryDescription = this.getAttribute('data-category-description');

            // Populate the form fields with the selected category data
            document.getElementById('productName').value = categoryName;
            document.getElementById('sku').value = categoryModel;
            document.getElementById('barcode').value = categoryType;
            document.getElementById('description').value = categoryDescription;

            // Show the edit form
            document.getElementById('editCategoryForm').style.display = 'block';

            // Optionally, scroll to the form
            document.getElementById('editCategoryForm').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    document.getElementById('editCategoryForm').addEventListener('submit', function(event) {
        const slugInput = document.getElementById('productName'); // Category name field
        const slugError = document.getElementById('slugErrorEdit'); // Slug error container
        const slugValue = slugInput.value.trim().toLowerCase(); // Get the slug value in lowercase

        // Simulated existing slugs for validation
        const existingSlugs = ['travel', 'smart-phone', 'shoes', 'jewellery', 'home-decor'];

        // Check for duplicate slug
        if (existingSlugs.includes(slugValue)) {
            event.preventDefault(); // Prevent form submission
            slugError.style.display = 'block'; // Show error message
        } else {
            slugError.style.display = 'none'; // Hide error message if no duplicate
            existingSlugs.push(slugValue); // Add the new slug to existing slugs
        }
    });
</script>


<script>
    let currentPage = 1;
    let entriesPerPage = 2;
    const entries = Array.from(document.querySelectorAll('#categoriesTable tr'));
    const totalEntries = entries.length;
    let productSortOrder = true; // true for ascending, false for descending
    let earningSortOrder = true;

    function updateTable() {
        // Hide all entries
        entries.forEach((row, index) => {
            row.style.display = 'none';
            if (index < currentPage * entriesPerPage && index >= (currentPage - 1) * entriesPerPage) {
                row.style.display = '';
            }
        });

        // Update entries info
        const start = (currentPage - 1) * entriesPerPage + 1;
        const end = Math.min(currentPage * entriesPerPage, totalEntries);
        document.getElementById('entriesInfo').innerText = `Showing ${start} to ${end} of ${totalEntries} entries`;

        // Update pagination
        document.getElementById('prevPage').classList.toggle('disabled', currentPage === 1);
        document.getElementById('nextPage').classList.toggle('disabled', currentPage * entriesPerPage >= totalEntries);
        document.querySelectorAll('.page-item').forEach(item => item.classList.remove('active'));
        document.getElementById(`page${currentPage}`).classList.add('active');
    }

    function changePage(page) {
        currentPage = page;
        updateTable();
    }

    document.getElementById('entriesPerPage').addEventListener('change', function() {
        entriesPerPage = parseInt(this.value);
        currentPage = 1; // Reset to first page
        updateTable();
    });

    // Pagination event listeners
    document.getElementById('prevPage').addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            changePage(currentPage - 1);
        }
    });

    document.getElementById('nextPage').addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage * entriesPerPage < totalEntries) {
            changePage(currentPage + 1);
        }
    });

    document.getElementById('page1').addEventListener('click', function(e) {
        e.preventDefault();
        changePage(1);
    });

    document.getElementById('page2').addEventListener('click', function(e) {
        e.preventDefault();
        changePage(2);
    });

    function sortTable(type) {
        if (type === 'products') {
            entries.sort((a, b) => {
                const productA = parseInt(a.querySelector('.product-count').innerText);
                const productB = parseInt(b.querySelector('.product-count').innerText);
                return productSortOrder ? productB - productA : productA - productB;
            });
            productSortOrder = !productSortOrder; // Toggle sort order
            document.getElementById('productSortIcon').innerHTML = productSortOrder ? '▲' : '▼';
        } else if (type === 'earning') {
            entries.sort((a, b) => {
                const earningA = parseFloat(a.querySelector('.earning').innerText.replace(/[$,]/g, ''));
                const earningB = parseFloat(b.querySelector('.earning').innerText.replace(/[$,]/g, ''));
                return earningSortOrder ? earningB - earningA : earningA - earningB;
            });
            earningSortOrder = !earningSortOrder; // Toggle sort order
            document.getElementById('earningSortIcon').innerHTML = earningSortOrder ? '▲' : '▼';
        }

        // Reattach sorted rows to the table body
        const tbody = document.getElementById('categoriesTable');
        entries.forEach(row => tbody.appendChild(row));

        // Update the table display after sorting
        updateTable();
    }

    // Initial table update
    updateTable();
</script>

<!-- Modal for Adding Category -->


<!-- <script>
    // Simulated existing slugs for validation
    const existingSlugs = ['travel', 'smart-phone', 'shoes', 'jewellery', 'home-decor'];

    document.getElementById('addCategoryForm').addEventListener('submit', function(event) {
        const slugInput = document.getElementById('categorySlug');
        const slugError = document.getElementById('slugError');
        const slugValue = slugInput.value.trim().toLowerCase();

        // Check for duplicate slug
        if (existingSlugs.includes(slugValue)) {
            event.preventDefault(); // Prevent form submission
            slugError.style.display = 'block'; // Show error message
        } else {
            slugError.style.display = 'none'; // Hide error message
            existingSlugs.push(slugValue); // Add the new slug to existing slugs
        }
    });

    // Update the file name display when a file is chosen
    const fileInput = document.getElementById('categoryAttachment');
    const fileNameDisplay = document.getElementById('fileName');

    fileInput.addEventListener('change', function() {
        const fileName = fileInput.files.length > 0 ? fileInput.files[0].name : 'No file chosen';
        fileNameDisplay.textContent = fileName;
    });
</script> -->