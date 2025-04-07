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
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="background-color: #d4edda;">
                <p class="text-muted mt-2 mb-1" style="color: #28a745;">Total Price</p>
            <h5 class="fw-bold" id="totalPrice" style="color: #28a745;">$0.00
                <i class="bi bi-cash-stack fs-3 text-success me-2"></i>
            </h5>
        </div>
    
    </div>

    <!-- Total Sold Items -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3 text-center" style="background-color: #ffe6e6;">
                <p class="text-muted mt-2 mb-1" style="color: #ff4d4d;">Total Discount</p>
            <h5 class="fw-bold" id="discountText" style="color: #ff4d4d;">$0.00
                <i class="bi bi-tags fs-3 text-danger me-2"></i>
            </h5>
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
                <tbody id="salesTableBody">
                <?php foreach ($sales as $index => $sale): ?>

                <tr class="border-bottom" 
                        data-sale-id="<?= htmlspecialchars($sale['sale_id']) ?>" 
                        data-customer-name="<?= htmlspecialchars($sale['customer_name']) ?>" 
                        data-sale-date="<?= htmlspecialchars($sale['sale_date']) ?>" 
                        data-sale-time="<?= htmlspecialchars($sale['sale_time']) ?>"
                        data-total-price="<?= htmlspecialchars($sale['total_price']) ?>"
                        onclick="showProductDetails(event)"
                        style="cursor: pointer;">
                        
                        <td><?= htmlspecialchars($sale['sale_id']) ?></td>
                        <td><?= htmlspecialchars($sale['customer_name']) ?></td>
                        <td><?= htmlspecialchars($sale['sale_date']) ?></td>
                        <td><?= htmlspecialchars($sale['total_price']) ?></td>

            
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0 m-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item text-warning" href="/order_new_product/edit/<?= $sale['sale_id'] ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="openDeleteModal('<?= htmlspecialchars($sale['customer_name']) ?>', '/sale_receipt/delete/<?= $sale['sale_id'] ?>')">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                        
                    <div class="dropdown">
                        <button class="btn btn-link text-muted p-0 m-1" type="button" id="dropdownMenuButton<?= $sale['sale_id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical fs-5"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $sale['sale_id'] ?>">
                            <li>
                                <a href="/sales/view/<?= $sale['sale_id'] ?>" class="dropdown-item text-primary">
                                    <i class="bi bi-eye fs-5"></i> View
                                </a>
                            </li>
                            <li>
                                    <a href="/sales/edit/<?= $sale['sale_id'] ?>" class="dropdown-item text-warning">
                                    <i class="bi bi-pencil-square fs-5"></i> Edit
                                 </a>
                                </li>
                                <li>
                                <a href="#" class="dropdown-item text-danger deleteSaleBtn"
                                     data-id="<?= $sale['sale_id'] ?>"
                                     data-name="<?= htmlspecialchars($sale['customer_name']) ?>"
                                     data-bs-toggle="modal" data-bs-target="#deleteSaleModal">
                                     <i class="bi bi-trash fs-5"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
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