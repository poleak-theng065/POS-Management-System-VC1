<style>
    th.sortable {
        cursor: pointer;
    }

    th.sortable:hover span {
        visibility: visible;
        /* Show icon on hover */
    }

    th span {
        visibility: hidden;
        /* Hide icon normally */
        margin-left: 5px;
        /* Space between header text and icon */
    }

    .card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .category-image {
        width: 50px;
        /* Adjust image size */
        height: auto;
    }
</style>

<div class="container d-flex flex-row">
    <!-- Total Profit Sold Product -->
    <div class="col-md-6 mb-4 d-flex">
        <div class="card p-3 flex-grow-1 d-flex flex-column">
            <div class="d-flex align-items-start">
                <div class="icon-right me-3">
                    <i class="fas fa-credit-card text-success fa-lg"></i>
                </div>
                <h5 class="h6 text-dark">Sold Profit</h5>
            </div>
            <div class="value text-dark" style="font-size: 1.5rem;">
                $
            </div>
            <div class="orders text-dark" style="font-size: 0.9rem;">
                The total profit for this month in sales.
            </div>
            <a href="/arrived_product" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </div>

    <!-- Total Sold Items -->
    <div class="col-md-6 mb-4 d-flex">
        <div class="card p-3 flex-grow-1 d-flex flex-column">
            <div class="d-flex align-items-start">
                <div class="icon-right me-3">
                    <i class="fas fa-box-open text-danger fa-lg"></i>
                </div>
                <h5 class="h6 text-dark">Sold Product</h5>
            </div>
            <div class="value text-dark" style="font-size: 1.5rem;">
                Items
            </div>
            <div class="orders text-dark" style="font-size: 0.9rem;">
                Total items sold successfully.
            </div>
            <a href="/sold_product" class="view-icon position-absolute top-0 end-0 p-2" data-bs-toggle="tooltip" title="View Details">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </div>
</div>

<!-- View sold product list -->
<div class="container mt-4">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block"
        style="border-left: 8px solid #198754; background-color: #f8f9fa;">
        <i class="bi bi-cart-check text-success me-2"></i> Sales Receipt
    </h1>

    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Costromer Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entryInfo">
                Showing <span id="startEntry">1</span> to <span id="endEntry">3</span> of <span id="totalEntries">3</span> entries
            </div>
            <nav>
                <ul class="pagination" id="pagination">
                    <li class="page-item disabled" id="prevPage">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active" id="page1">
                        <a class="page-link" href="#">1</a>
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