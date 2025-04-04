
<?php session_start(); ?> 
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>
<div class="container mt-4">
    <!-- <h1>Order Details</h1> -->

    <div class="row text-center">

        <!-- Need to Order -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 card-container position-relative">
                <!-- Title with Icon -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="icon-right">
                        <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                    </div>
                </div>

                <!-- Need to Order text in center at the top -->
                <div class="text-center">
                    <h5 class="h6 text-dark">Need to Order</h5>
                </div>

                <div class="d-flex justify-content-between">
                    <!-- Display Low Stock Count -->
                    <div class="low-stock text-center" style="flex: 1;">
                        <div class="value text-dark" style="font-size: 2rem; font-weight: bold;">
                        </div>
                        <div class="text-dark" style="font-size: 0.9rem;">
                            Low Stock
                        </div>
                    </div>

                    <!-- Display Out of Stock Count -->
                    <div class="out-of-stock text-center" style="flex: 1;">
                        <div class="value text-dark" style="font-size: 2rem; font-weight: bold;">
                        </div>
                        <div class="text-dark" style="font-size: 0.9rem;">
                            Out of Stock
                        </div>
                    </div>
                </div>

                <!-- View icon positioned at top-right -->
                <a href="#" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
            </div>
        </div>

        <!-- Modal for showing low stock and out of stock product details -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger fw-bold fs-4" id="orderDetailsModalLabel">
                            <i class="bi bi-box-arrow-down-right me-2"></i> Low and Out of Stock Products
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="orderDetailsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="lowStockTab" data-bs-toggle="tab" href="#lowStock" role="tab" aria-controls="lowStock" aria-selected="true">Low Stock</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="outOfStockTab" data-bs-toggle="tab" href="#outOfStock" role="tab" aria-controls="outOfStock" aria-selected="false">Out of Stock</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="orderDetailsTabContent">
                            <!-- Low Stock Tab -->
                            <div class="tab-pane fade show active" id="lowStock" role="tabpanel" aria-labelledby="lowStockTab">
                                <h6 class="text-warning fw-bold fs-5 mb-3">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Low Stock Products
                                </h6>


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Barcode</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <!-- <tbody>
                                        
                                    </tbody> -->
                                </table>
                            </div>

                            <!-- Out of Stock Tab -->
                            <div class="tab-pane fade" id="outOfStock" role="tabpanel" aria-labelledby="outOfStockTab">
                                <h6 class="text-danger fw-bold fs-5 mb-3">
                                    <i class="bi bi-cart-x-fill me-2"></i> Out of Stock Products
                                </h6>



                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Barcode</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



            <!-- Arrived Product -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container position-relative">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-box-open text-success fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Arrived</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">

                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Newly arrived stock ready for sale.
                    </div>
                    <!-- View icon positioned at top-right of the card -->
                    <a href="/arrived_product" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>


          
            <!-- Delivery Product -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container position-relative">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-truck text-primary fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Delivery</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                         Products
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Products on the way for delivery.
                    </div>
                    <!-- View icon positioned at top-right of the card -->
                    <a href="#" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" data-bs-target="#deliveryDetailsModal" title="View Details" onclick="loadDeliveryDetails()">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Modal to display delivery details -->
            <div class="modal fade" id="deliveryDetailsModal" tabindex="-1" aria-labelledby="deliveryDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title text-primary fw-bold fs-4" id="deliveryDetailsModalLabel">
                                <i class="fas fa-truck text-primary me-2"></i> Delivery Products
                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Order Date</th>
                                        <th>Supplier</th> <!-- Added Supplier column -->
                                    </tr>
                                </thead>
                                <tbody id="deliveryProductList">
                                    <script>
                                        function loadDeliveryDetails() {
                                            // The array of delivery products
                                            const deliveryProducts = [
                                                
                                            ];

                                            // Get the table body where the delivery products will be listed
                                            const tableBody = document.getElementById("deliveryProductList");

                                            // Clear any previous content in the table body
                                            tableBody.innerHTML = '';

                                            // Loop through the delivery products and insert them into the table
                                            deliveryProducts.forEach(product => {
                                                const row = document.createElement('tr');
                                                row.innerHTML = `
                                                    <td>${product.id}</td>
                                                    <td>${product.product_name}</td>
                                                    <td>${product.quantity}</td>
                                                    <td>${product.order_date}</td>
                                                    <td>${product.supplier}</td> <!-- Added supplier data -->
                                                `;
                                                tableBody.appendChild(row);
                                            });
                                        }
                                    </script>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



          
            <!-- Total Order -->
            <div class="col-md-3 mb-4">
                <div class="card p-3 card-container">
                    <div class="d-flex justify-content-between">
                        <div class="icon-right"><i class="fas fa-shopping-cart text-info fa-lg"></i></div>
                    </div>
                    <h5 class="h6 text-dark">Orders</h5>
                    <div class="value text-dark" style="font-size: 1.5rem;">
                       Orders
                    </div>
                    <div class="orders text-dark" style="font-size: 0.9rem;">
                        Total number of orders placed.
                    </div>
                    <!-- View icon positioned at top-right of the card -->
                    <a href="#" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="modal" data-bs-target="#orderProductModal" title="View Details" onclick="loadOrderDetails()">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Modal to display order details -->
            <div class="modal fade" id="orderProductModal" tabindex="-1" aria-labelledby="orderProductModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-info fw-bold fs-4" id="orderProductModalLabel">
                                <i class="fas fa-shopping-cart text-info me-2"></i> Order Products
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Order Date</th>
                                        <th>Supplier</th>
                                    </tr>
                                </thead>
                                <tbody id="orderProductList">
                                    <!-- Data will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function loadOrderDetails() {
                    // The array of order products
                    const orderProducts = [
                        
                    ];

                    // Get the table body where the order products will be listed
                    const tableBody = document.getElementById("orderProductList");

                    // Clear any previous content in the table body
                    tableBody.innerHTML = '';

                    // Loop through the order products and insert them into the table
                    orderProducts.forEach(product => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${product.id}</td>
                            <td>${product.product_name}</td>
                            <td>${product.quantity}</td>
                            <td>${product.order_date}</td>
                            <td>${product.supplier}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            </script>
        </div>

    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex">
                <input type="text" class="form-control me-2" placeholder="Search Product" id="searchOrderInput" onkeyup="searchOrders()" style="width: 200px;">
                <select class="form-select" id="filterSelect" onchange="filterOrders()" style="width: 200px;">
                    <option value="">Filter by Status</option>
                    <option value="Delivery">Delivery</option>
                    <option value="Arrived">Arrived</option>
                    <option value="Order">Order</option>
                </select>
            </div>
             <!-- Buttons and Export Dropdown -->
            <div class="d-flex align-items-center">
                <!-- <div class="btn-group me-2">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-file-earmark-arrow-down me-2"></i> Export
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportButton">
                        <li>
                            <form method="POST">
                                <button type="submit" name="export_excel" class="dropdown-item">
                                    <i class="bi bi-file-earmark-excel me-2"></i> Export to Excel
                                </button>
                            </form>
                        </li>
                        <li>
                            <form method="POST">
                                <button type="submit" name="export_pdf" class="dropdown-item">
                                    <i class="bi bi-file-earmark-pdf me-2"></i> Export to PDF
                                </button>
                            </form>
                        </li>
                    </ul>
                </div> -->

                <a href="/order_new_product/create" class="btn btn-primary">+ Add New Order</a>
            </div>
            
        </div>

        <!-- <form action="/order_new_product/upload" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileUpload" class="form-label">Upload Orders (Excel Only)</label>
                <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept=".xls, .xlsx">
            </div>
            <button type="submit" class="btn btn-success mt-2">Upload</button>
        </form> -->




        <div class="table-responsive">
            <table class="table table-hover align-middle" id="orderTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price USD</th>
                        <th>Total USD</th>
                        <th>Order Date</th>
                        <th>Expected Delivery</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="switchTableBody">
                    <?php // foreach($newOrders as $newOrder): ?>
                    <tr class="border-bottom" 
                        data-id="<?= htmlspecialchars($newOrder['id']) ?>" 
                        data-product-name="<?= htmlspecialchars($newOrder['product_name']) ?>" 
                        data-quantity="<?= htmlspecialchars($newOrder['quantity']) ?>" 
                        data-base-price-usd="<?= htmlspecialchars($newOrder['base_price_usd']) ?>"
                        data-total-price-usd="<?= htmlspecialchars($newOrder['total_price_usd']) ?>"
                        data-order-date="<?= htmlspecialchars($newOrder['order_date']) ?>" 
                        data-expected-delivery="<?= htmlspecialchars($newOrder['expected_delivery']) ?>" 
                        data-supplier="<?= htmlspecialchars($newOrder['supplier']) ?>"
                        onclick="showProductDetails(event)"
                        style="cursor: pointer;">
                        
                        
                            
            </table>

            <!-- Pagination Component -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div id="entriesInfo" class="text-muted">
                  
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
                <p><strong>Order ID:</strong> <span id="modal-order-id"></span></p>
                <p><strong>Product Name:</strong> <span id="modal-product-name"></span></p>
                <p><strong>Quantity:</strong> <span id="modal-quantity"></span></p>
                <p><strong>Order Date:</strong> <span id="modal-order-date"></span></p>
                <p><strong>Expected Delivery:</strong> <span id="modal-expected-delivery"></span></p>
                <p><strong>Supplier:</strong> <span id="modal-supplier"></span></p>
                <p><strong>Base Price USD:</strong> <span id="modal-base_price_usd"></span></p>
                <p><strong>Total Price USD:</strong> <span id="modal-total_price_usd"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
function showProductDetails(event) {
    let target = event.target;

    // Prevent click on dropdown menu from triggering modal
    if (target.closest(".dropdown") || target.closest("button") || target.closest("a")) {
        return;
    }

    let row = target.closest("tr");
    if (row) {
        // Set modal data
        document.getElementById("modal-order-id").textContent = row.getAttribute("data-id");
        document.getElementById("modal-product-name").textContent = row.getAttribute("data-product-name");
        document.getElementById("modal-quantity").textContent = row.getAttribute("data-quantity");
        document.getElementById("modal-order-date").textContent = row.getAttribute("data-order-date");
        document.getElementById("modal-expected-delivery").textContent = row.getAttribute("data-expected-delivery");
        document.getElementById("modal-supplier").textContent = row.getAttribute("data-supplier");
        document.getElementById("modal-base_price_usd").textContent = row.getAttribute("data-base-price-usd");
        document.getElementById("modal-total_price_usd").textContent = row.getAttribute("data-total-price-usd");

        // Show the Bootstrap modal
        let modal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
        modal.show();
    }
}
</script>

<!-- Filter  -->
 <script>
    // Function to filter orders based on the selected status
    function filterOrders() {
        // Get the selected value from the dropdown
        const filterValue = document.getElementById('filterSelect').value;
        
        // Get all table rows
        const rows = document.querySelectorAll('#switchTableBody tr');
        
        // Loop through the rows and check the expected_delivery value
        rows.forEach(row => {
            // Get the expected_delivery value from the data attribute
            const expectedDelivery = row.getAttribute('data-expected-delivery');
            
            // If no filter is selected, show all rows
            if (filterValue === '' || expectedDelivery === filterValue) {
                row.style.display = '';  // Show the row
            } else {
                row.style.display = 'none';  // Hide the row
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
                <p>Are you sure you want to delete this order?</p>
                <p id="productName" class="fw-bold"></p> <!-- To display the product name -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm delete -->
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


<!-- Export excel and pdf -->
<script>
    async function exportToExcel() {
        const table = document.getElementById("orderTable");
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet("Orders");

        // Extract headers while ignoring the last "Action" column
        const headers = [];
        table.querySelectorAll("thead tr th").forEach((th, index, arr) => {
            if (index !== arr.length - 1) headers.push(th.innerText);
        });

        // Apply styles to headers
        worksheet.addRow(headers).eachCell((cell) => {
            cell.font = { bold: true, color: { argb: "FFFFFFFF" } }; // White text
            cell.fill = { type: "pattern", pattern: "solid", fgColor: { argb: "4F81BD" } }; // Blue background
            cell.alignment = { horizontal: "center", vertical: "middle" };
            cell.border = { bottom: { style: "thin" } };
        });

        // Extract and style table data while ignoring the "Action" column
        const rows = [];
        table.querySelectorAll("tbody tr").forEach((row, rowIndex) => {
            const rowData = [];
            row.querySelectorAll("td").forEach((cell, cellIndex, arr) => {
                if (cellIndex !== arr.length - 1) rowData.push(cell.innerText);
            });
            const addedRow = worksheet.addRow(rowData);

            // Alternate row colors for better readability
            if (rowIndex % 2 !== 0) {
                addedRow.eachCell((cell) => {
                    cell.fill = { type: "pattern", pattern: "solid", fgColor: { argb: "F2F2F2" } }; // Light gray
                });
            }

            // Add borders to all cells
            addedRow.eachCell((cell) => {
                cell.border = {
                    top: { style: "thin" },
                    bottom: { style: "thin" },
                    left: { style: "thin" },
                    right: { style: "thin" }
                };
            });
        });

        // Auto-size columns
        worksheet.columns.forEach((column) => {
            column.width = 20;
        });

        // Create and download the Excel file
        const buffer = await workbook.xlsx.writeBuffer();
        const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "orders.xlsx";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    document.querySelector("button[name='export_excel']").addEventListener("click", function (event) {
        event.preventDefault();
        exportToExcel();
    });
</script>

<!-- export to pdf -->
<script>
    async function exportToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add Store Name and Description at the top of the PDF
        const storeName = "Here you can find the best products and services.";
        const storeDescription = "Order Product List";
        const title = "Heng Heng";

        // Set title
        doc.setFontSize(16);
        doc.setFont("helvetica", "bold");
        doc.text(title, 14, 20);  // Add title with larger font size

        // Set store name and description
        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");
        doc.text(storeName, 14, 30);
        doc.text(storeDescription, 14, 36);

        // Add a line break before table
        doc.line(14, 40, 200, 40);  // Line separating title and table

        const table = document.getElementById("orderTable");
        const rows = [];
        const headers = [];
        
        // Extract headers while ignoring "Action" column
        const headerCells = table.querySelectorAll("thead tr th");
        headerCells.forEach((th, index, arr) => {
            if (index !== arr.length - 1) headers.push(th.innerText);
        });

        // Extract table rows while ignoring the "Action" column
        table.querySelectorAll("tbody tr").forEach(row => {
            const rowData = [];
            const cells = row.querySelectorAll("td");
            cells.forEach((cell, index, arr) => {
                if (index !== arr.length - 1) rowData.push(cell.innerText);
            });
            rows.push(rowData);
        });

        // Define column styles and colors
        const columnStyles = {};
        const statusIndex = headers.findIndex((h) => h.toLowerCase().includes("status"));

        rows.forEach((row, index) => {
            const status = row[statusIndex]?.toLowerCase() || "";
            let bgColor = ""; // Default no background

            if (status.includes("completed")) bgColor = "#c6efce"; // Green
            else if (status.includes("pending")) bgColor = "#fff2cc"; // Yellow
            else if (status.includes("canceled")) bgColor = "#f4cccc"; // Red
            else if (index % 2 !== 0) bgColor = "#f2f2f2"; // Light Gray (Alternating)

            if (bgColor) {
                columnStyles[index] = { fillColor: bgColor };
            }
        });

        // Generate PDF table with styling
        doc.autoTable({
            head: [headers],
            body: rows,
            theme: "grid",
            startY: 45,  // Start the table after the description
            styles: {
                font: "helvetica",
                fontSize: 10,
                textColor: [0, 0, 0],
                cellPadding: 4,
            },
            headStyles: {
                fillColor: [31, 78, 120], // Dark Blue header
                textColor: 255, // White text
                fontStyle: "bold",
                halign: "center",
            },
            alternateRowStyles: {
                fillColor: [242, 242, 242], // Light gray for alternating rows
            },
            columnStyles: columnStyles,
        });

        // Save the PDF
        doc.save("orders.pdf");
    }

    document.querySelector("button[name='export_pdf']").addEventListener("click", function(event) {
        event.preventDefault();
        exportToPDF();
    });
</script>

<?php else: ?>
<?php $this->redirect('/login'); ?>
<?php endif; ?>
