<style>
    th.sortable {
        cursor: pointer;
    }

    th.sortable:hover span {
        visibility: visible;
    }

    th span {
        visibility: hidden;
        margin-left: 5px;
    }

    .card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .category-image {
        width: 50px;
        height: auto;
    }
</style>

<!-- View sold product list -->
<div class="container mt-4">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block"
        style="border-left: 8px solid #198754; background-color: #f8f9fa;">
        <i class="bi bi-cart-check text-success me-2"></i> Sales Receipt
    </h1>

    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="salesTable">
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                    <?php foreach ($sales as $sale): ?>
                        <tr class="border-bottom" 
                            data-sale-id="<?= htmlspecialchars($sale['sale_id']) ?>" 
                            data-customer-name="<?= htmlspecialchars($sale['customer_name']) ?>" 
                            data-sale-date="<?= htmlspecialchars($sale['sale_date']) ?>" 
                            data-sale-time="<?= htmlspecialchars($sale['sale_time']) ?>"
                            data-total-price="<?= htmlspecialchars($sale['total_amount']) ?>"
                            onclick="showProductDetails(event)"
                            style="cursor: pointer;">
                            
                            <td><?= htmlspecialchars($sale['sale_id']) ?></td>
                            <td><?= htmlspecialchars($sale['customer_name']) ?></td>
                            <td><?= htmlspecialchars($sale['sale_date']) ?></td>
                            <td><?= htmlspecialchars($sale['sale_time']) ?></td>
                            <td><?= htmlspecialchars($sale['total_amount']) ?></td>

                            <td>
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
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entryInfo">
                Showing <span id="startEntry">1</span> to <span id="endEntry"><?= count($sales) ?></span> of <span id="totalEntries"><?= count($sales) ?></span> entries
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
    // Initialize total price and discount
    document.addEventListener('DOMContentLoaded', function() {
        calculateTotals();
    });

    function calculateTotals() {
        let totalPrice = 0;
        let totalDiscount = 0;
        
        document.querySelectorAll('#salesTableBody tr').forEach(row => {
            const price = parseFloat(row.dataset.totalPrice) || 0;
            totalPrice += price;
        });
        
        document.getElementById('totalPrice').textContent = '$' + totalPrice.toFixed(2);
        document.getElementById('discountText').textContent = '$' + totalDiscount.toFixed(2);
    }

    async function exportToExcel() {
        try {
            const ExcelJS = window.ExcelJS;
            const table = document.getElementById("salesTable");
            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet("Sales");

            // Extract headers while ignoring the last "Action" column
            const headers = [];
            table.querySelectorAll("thead tr th").forEach((th, index, arr) => {
                if (index !== arr.length - 1) headers.push(th.innerText);
            });

            // Apply styles to headers
            worksheet.addRow(headers).eachCell((cell) => {
                cell.font = { bold: true, color: { argb: "FFFFFFFF" } };
                cell.fill = { type: "pattern", pattern: "solid", fgColor: { argb: "4F81BD" } };
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
                        cell.fill = { type: "pattern", pattern: "solid", fgColor: { argb: "F2F2F2" } };
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
            link.download = "sales_report.xlsx";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } catch (error) {
            console.error("Error exporting to Excel:", error);
            alert("Error exporting to Excel. Please try again.");
        }
    }

    // If you have an export button, add this event listener
    const exportBtn = document.querySelector("button[name='export_excel']");
    if (exportBtn) {
        exportBtn.addEventListener("click", function(event) {
            event.preventDefault();
            exportToExcel();
        });
    }

    function showProductDetails(event) {
    // Prevent triggering when clicking on dropdown menu or action buttons
    if (event.target.closest('.dropdown') || event.target.closest('a') || event.target.closest('button')) {
        return;
    }

    const row = event.currentTarget;
    const saleId = row.dataset.saleId;
    const productHTML = row.innerHTML;

    // Extract data from dataset or cells
    const date = row.dataset.date || new Date().toLocaleDateString();
    const customer = row.dataset.customer || 'Walk-in Customer';
    const phone = row.dataset.phone || 'N/A';

    // Extract product details from the row (assuming you store them somehow)
    const productRows = row.querySelector('tbody') ? row.querySelector('tbody').innerHTML : '';

    // Calculate totalPrice and totalDiscount
    let totalPrice = 0;
    let totalDiscount = 0;

    row.querySelectorAll('tbody tr').forEach(tr => {
        const qty = parseFloat(tr.querySelector('.qty')?.textContent || 0);
        const price = parseFloat(tr.querySelector('.price')?.textContent || 0);
        const discount = parseFloat(tr.querySelector('.discount')?.textContent || 0);

        totalPrice += (qty * price) - discount;
        totalDiscount += discount;
    });

    const detailWindow = window.open('', '_blank');

    detailWindow.document.write(`
        <html>
        <head>
            <title>Digital Invoice</title>
            <style>
                @media print { 
                    .no-print { display: none; } 
                    body { font-size: 12px; }
                }
                body { 
                    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif; 
                    padding: 0;
                    margin: 0;
                    background-color: #f8f9fa;
                    color: #333;
                }
                .invoice-container { 
                    max-width: 500px; 
                    margin: 20px auto; 
                    background: white;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                    border-radius: 8px;
                    overflow: hidden;
                }
                .invoice-header {
                    background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
                    color: white;
                    padding: 25px;
                    text-align: center;
                }
                .invoice-header h1 {
                    margin: 0;
                    font-size: 1.8em;
                    font-weight: 600;
                }
                .invoice-header p {
                    margin: 5px 0 0;
                    opacity: 0.9;
                    font-size: 0.9em;
                }
                .invoice-body {
                    padding: 25px;
                }
                .invoice-info {
                    display: flex;
                    justify-content: space-between;
                    flex-direction: column;
                    margin-bottom: 20px;
                    flex-wrap: wrap;
                }
                .info-block {
                    margin-bottom: 15px;
                    display: flex;
                    flex-direction: row;
                    gap: 5px;
                }
                .info-block h3 {
                    margin: 0 0 5px;
                    font-size: 1em;
                    color: #666;
                }
                .info-block p {
                    margin: 0;
                    font-weight: 500;
                }
                .divider {
                    height: 1px;
                    background: linear-gradient(to right, transparent, #ddd, transparent);
                    margin: 20px 0;
                }
                table {
                    width: 100%; 
                    border-collapse: collapse;
                    font-size: 0.95em;
                }
                th {
                    text-align: left;
                    padding: 12px 8px;
                    background-color: #f5f7ff;
                    color: #555;
                    font-weight: 600;
                    text-transform: uppercase;
                    font-size: 0.8em;
                    letter-spacing: 0.5px;
                }
                td {
                    padding: 12px 8px;
                    border-bottom: 1px solid #eee;
                }
                .text-right {
                    text-align: right;
                }
                .total-row {
                    font-weight: bold;
                    background-color: #f9f9f9;
                }
                .total-row td {
                    border-bottom: none;
                    padding-top: 15px;
                    padding-bottom: 15px;
                }
                .grand-total {
                    font-size: 1.1em;
                    color: #000DFF;
                }
                .footer {
                    text-align: center;
                    padding: 15px;
                    color: #777;
                    font-size: 0.85em;
                    background-color: #f8f9fa;
                    border-top: 1px solid #eee;
                }
                .no-print {
                    text-align: center;
                    margin: 20px auto;
                    max-width: 500px;
                }
                button {
                    padding: 10px 20px;
                    border: none;
                    border-radius: 6px;
                    font-weight: 500;
                    cursor: pointer;
                    transition: all 0.2s;
                    margin: 0 5px;
                }
                .print-btn {
                    background: #4CAF50;
                    color: white;
                }
                .print-btn:hover {
                    background: #3e8e41;
                }
                .close-btn {
                    background: #f44336;
                    color: white;
                }
                .close-btn:hover {
                    background: #d32f2f;
                }
            </style>
        </head>
        <body>
            <div class="invoice-container">
                <div class="invoice-header">
                    <h1>HENG HENG</h1>
                    <p>Phnom Penh, Cambodia | +855 123 456 789</p>
                </div>
                
                <div class="invoice-body">
                    <div class="invoice-info">
                        <div class="info-block">
                            <h3>Invoice Date: </h3>
                            <p>${date}</p>
                        </div>
                        <div class="info-block">
                            <h3>Customer: </h3>
                            <p>${customer}</p>
                        </div>
                        <div class="info-block">
                            <h3>Phone: </h3>
                            <p>${phone}</p>
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Disc</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${productRows}
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="4">Subtotal</td>
                                <td class="text-right">$${(totalPrice + totalDiscount).toFixed(2)}</td>
                            </tr>
                            <tr class="total-row">
                                <td colspan="4">Total Discount</td>
                                <td class="text-right">-$${totalDiscount.toFixed(2)}</td>
                            </tr>
                            <tr class="total-row grand-total">
                                <td colspan="4">Amount Due</td>
                                <td class="text-right">$${totalPrice.toFixed(2)}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="footer">
                    Thank you for your business! | Terms & Conditions Apply
                </div>
            </div>
            
            <div class="no-print">
                <button onclick="window.print()" class="print-btn">Print Invoice</button>
                <button onclick="window.close()" class="close-btn">Close Window</button>
            </div>
        </body>
        </html>
    `);

    detailWindow.document.close();
}


</script>