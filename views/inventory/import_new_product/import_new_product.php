<!-- Container for the table -->
<div class="container mt-4">
    <h1>Seller Imported Products</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="form-control" placeholder="Search Product" style="width: 200px;">
            <a href="/import_product" class="btn btn-primary ms-2">
                + Import Product
            </a>
        </div>

        <div class="mb-4">
            <label for="fileUpload" class="form-label">Import Products (PDF or Excel)</label>
            <input type="file" class="form-control" id="fileUpload" accept=".pdf, .xls, .xlsx">
            <button class="btn btn-success mt-2" onclick="importProducts()">Upload</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="importedProductTable">
                <thead>
                    <tr class="border-0">
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Import Date</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($new_imports as $new_import): ?>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td> <?= htmlspecialchars($new_import['id'])?> </td>
                        <td> <?= htmlspecialchars($new_import['product_name'])?> </td>
                        <td> <?= htmlspecialchars($new_import['quantity'])?> </td>
                        <td> <?= htmlspecialchars($new_import['import_date'])?> </td>
                        <td> <?= htmlspecialchars($new_import['supplier'])?> </td>
                        <td><span class="badge bg-warning"><?= htmlspecialchars($new_import['status'])?></span></td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function importProducts() {
        const fileInput = document.getElementById('fileUpload');
        const file = fileInput.files[0];

        if (!file) {
            alert("Please select a file to upload.");
            return;
        }

        const fileType = file.name.split('.').pop().toLowerCase();
        if (fileType !== 'pdf' && fileType !== 'xls' && fileType !== 'xlsx') {
            alert("Please upload a PDF or Excel file.");
            return;
        }

        // Implement the logic to process the file upload
        console.log("File ready to upload:", file.name);

        // You can add your AJAX call or form submission logic here
    }
</script>