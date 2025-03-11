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
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Import Date</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample imported product entries -->
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product A</td>
                        <td>50</td>
                        <td>March 5, 2023</td>
                        <td>Supplier X</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Product B</td>
                        <td>30</td>
                        <td>March 8, 2023</td>
                        <td>Supplier Y</td>
                        <td><span class="badge bg-success">Ready</span></td>
                        <td>
                            <a href="#" class="text-warning me-2"><i class="bi bi-pencil-square fs-4"></i></a>
                            <a href="#" class="text-danger"><i class="bi bi-trash fs-4"></i></a>
                        </td>
                    </tr>
                    <!-- Additional rows can be added here -->
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