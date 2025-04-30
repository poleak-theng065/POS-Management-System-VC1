<?php
// At the top of your view file, ensure you have access to $sales data
// This would come from your controller
?>

<style>
    /* Your original styles remain unchanged */
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
    .loading-spinner {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }
    .spinner {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="container mt-4">
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block"
        style="border-left: 8px solid #198754; background-color: #f8f9fa;">
        <i class="bi bi-cart-check text-success me-2"></i> Sales Receipt
    </h1>

    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

    <div class="card p-5 bg-white shadow-lg border-0 mt-3">
        <div class="d-flex justify-content-between mb-3">
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Search sales..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            <button class="btn btn-success" name="export_excel" id="exportExcelBtn">
                <i class="bi bi-file-earmark-excel me-2"></i>Export to Excel
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="salesTable">
                <thead>
                    <tr>
                        <th class="sortable">Sale ID <span>↕</span></th>
                        <th class="sortable">Customer Name <span>↕</span></th>
                        <th class="sortable">Date <span>↕</span></th>
                        <th class="sortable">Time <span>↕</span></th>
                        <th class="sortable">Total <span>↕</span></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                    <?php if (!empty($sales)): ?>
                        <?php foreach ($sales as $saleId => $sale): ?>
                            <?php 
                            // Format data for display
                            $customerName = htmlspecialchars($sale['customer_name'] ?? 'Walk-in Customer');
                            $saleDate = date('M j, Y', strtotime($sale['sale_date']));
                            $saleTime = htmlspecialchars($sale['sale_time'] ?? '');
                            $totalAmount = number_format($sale['total_amount'] ?? 0, 2);
                            $phoneNumber = htmlspecialchars($sale['phone_number'] ?? 'N/A');
                            $productsJson = htmlspecialchars(json_encode($sale['products'] ?? []));
                            ?>
                            
                            <tr class="border-bottom sale-row" 
                                data-sale-id="<?= $sale['sale_id'] ?>" 
                                data-customer-name="<?= $customerName ?>" 
                                data-sale-date="<?= $sale['sale_date'] ?>" 
                                data-sale-time="<?= $saleTime ?>"
                                data-total-price="<?= $sale['total_amount'] ?>"
                                data-phone-number="<?= $phoneNumber ?>"
                                data-products='<?= $productsJson ?>'>
                                
                                <td><?= $sale['sale_id'] ?></td>
                                <td><?= $customerName ?></td>
                                <td><?= $saleDate ?></td>
                                <td><?= $saleTime ?></td>
                                <td>$<?= $totalAmount ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0 m-1" type="button" 
                                            id="dropdownMenuButton<?= $sale['sale_id'] ?>" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical fs-5"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $sale['sale_id'] ?>">
                                            <li><a class="dropdown-item text-primary view-sale" 
                                                href="/sales/view/<?= $sale['sale_id'] ?>">
                                                <i class="bi bi-eye fs-5 me-2"></i>View
                                            </a></li>
                                            <li><a class="dropdown-item text-warning" 
                                                href="/sales/edit/<?= $sale['sale_id'] ?>">
                                                <i class="bi bi-pencil-square fs-5 me-2"></i>Edit
                                            </a></li>
                                            <li><a class="dropdown-item text-danger deleteSaleBtn"
                                                data-id="<?= $sale['sale_id'] ?>"
                                                data-name="<?= $customerName ?>"
                                                data-bs-toggle="modal" data-bs-target="#deleteSaleModal">
                                                <i class="bi bi-trash fs-5 me-2"></i>Delete
                                            </a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">No sales records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="entryInfo">
                Showing <span id="startEntry">1</span> to <span id="endEntry"><?= count($sales) ?></span> 
                of <span id="totalEntries"><?= count($sales) ?></span> entries
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

<!-- Add ExcelJS library for export functionality -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>
    // Helper functions
    function showLoading() {
        document.getElementById('loadingSpinner').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loadingSpinner').style.display = 'none';
    }

    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return isNaN(date) ? dateString : date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }

    // Product details modal
    function showProductDetails(saleId) {
        showLoading();
        
        try {
            const row = document.querySelector(`.sale-row[data-sale-id="${saleId}"]`);
            if (!row) {
                alert("Sale data not found");
                hideLoading();
                return;
            }

            const saleData = {
                sale_id: row.dataset.saleId,
                customer_name: row.dataset.customerName || 'Walk-in Customer',
                sale_date: formatDate(row.dataset.saleDate),
                sale_time: row.dataset.saleTime || '',
                total_amount: parseFloat(row.dataset.totalPrice) || 0,
                phone_number: row.dataset.phoneNumber || 'N/A',
                products: JSON.parse(row.dataset.products || '[]')
            };

            if (saleData.products.length === 0) {
                alert("No products found for this sale.");
                hideLoading();
                return;
            }

            // Calculate totals

            const totalDiscount = saleData.products.reduce((sum, product) => {
                return sum + (parseFloat(product.discount) || 0);
            }, 0);

            const subtotal = saleData.total_amount + totalDiscount;

            // Generate product rows
            const productRows = saleData.products.map(product => {
                const unitPrice = parseFloat(product.unit_price) || 0;
                const discount = parseFloat(product.discount) || 0;
                const totalPrice = unitPrice - discount;
                
                return `
                    <tr>
                        <td>${product.name || 'N/A'}</td>
                        <td>${product.quantity || 0}</td>
                        <td>$${unitPrice.toFixed(2)}</td>
                        <td>$${discount.toFixed(2)}</td>
                        <td>$${totalPrice.toFixed(2)}</td>
                    </tr>
                `;
            }).join('');

            // Create invoice window
            const invoiceWindow = window.open('', '_blank', 'width=800,height=600');
            if (!invoiceWindow) {
                alert("Popup window was blocked. Please allow popups for this site.");
                hideLoading();
                return;
            }

            invoiceWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Invoice #${saleData.sale_id}</title>
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
                            margin-bottom: 20px;
                            flex-wrap: wrap;
                        }
                        .info-block {
                            margin-bottom: 15px;
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
                                    <h3>Invoice #${saleData.sale_id}</h3>
                                    <p>Date: ${saleData.sale_date}</p>
                                    <p>Time: ${saleData.sale_time}</p>
                                </div>
                                <div class="info-block">
                                    <h3>Customer:</h3>
                                    <p>${saleData.customer_name}</p>
                                    <p>Phone: ${saleData.phone_number}</p>
                                </div>
                            </div>
                            <hr>
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
                                        <td>$${subtotal.toFixed(2)}</td>
                                    </tr>
                                    <tr class="total-row">
                                        <td colspan="4">Total Discount</td>
                                        <td>-$${totalDiscount.toFixed(2)}</td>
                                    </tr>
                                    <tr class="total-row grand-total">
                                        <td colspan="4">Amount Due</td>
                                        <td>$${saleData.total_amount.toFixed(2)}</td>
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
            invoiceWindow.document.close();
            hideLoading();
        } catch (error) {
            console.error("Error showing product details:", error);
            alert("An error occurred while displaying the invoice. Details: " + error.message);
            hideLoading();
        }
    }

    // Sorting functionality
    function sortTable(columnIndex, header) {
        const table = document.getElementById('salesTable');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr:not([style*="display: none"])'));
        const isAscending = !header.classList.contains('asc');
        
        // Clear previous sort indicators
        document.querySelectorAll('.sortable').forEach(h => {
            h.classList.remove('asc', 'desc');
            h.querySelector('span').textContent = '↕';
        });
        
        // Set new sort indicator
        header.classList.add(isAscending ? 'asc' : 'desc');
        header.querySelector('span').textContent = isAscending ? '↑' : '↓';
        
        rows.sort((a, b) => {
            let aValue = a.cells[columnIndex].textContent;
            let bValue = b.cells[columnIndex].textContent;
            
            // Handle numeric values
            if (columnIndex === 4) { // Price column
                aValue = parseFloat(aValue.replace('$', '')) || 0;
                bValue = parseFloat(bValue.replace('$', '')) || 0;
            }
            // Handle date values
            else if (columnIndex === 2) { // Date column
                aValue = new Date(aValue);
                bValue = new Date(bValue);
            }
            
            return isAscending 
                ? aValue > bValue ? 1 : -1
                : aValue < bValue ? 1 : -1;
        });
        
        // Rebuild table
        rows.forEach(row => tbody.appendChild(row));
        updateEntryInfo();
    }

    // Update entry information
    function updateEntryInfo() {
        const visibleRows = document.querySelectorAll('#salesTableBody tr:not([style*="display: none"])');
        document.getElementById('startEntry').textContent = 1;
        document.getElementById('endEntry').textContent = visibleRows.length;
        document.getElementById('totalEntries').textContent = visibleRows.length;
    }

    // Export to Excel
    async function exportToExcel() {
        showLoading();
        try {
            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet("Sales Report");
            
            // Add headers
            const headers = [];
            document.querySelectorAll('#salesTable thead th').forEach((th, index) => {
                if (index < 5) headers.push(th.textContent.trim().replace('↕', '').trim());
            });
            
            worksheet.addRow(headers);
            
            // Style headers
            const headerRow = worksheet.getRow(1);
            headerRow.eachCell(cell => {
                cell.font = { bold: true };
                cell.fill = {
                    type: 'pattern',
                    pattern: 'solid',
                    fgColor: { argb: 'FF4F81BD' }
                };
                cell.alignment = { horizontal: 'center' };
            });
            
            // Add data rows
            document.querySelectorAll('#salesTableBody tr').forEach(row => {
                if (row.style.display === 'none') return;
                
                const rowData = [];
                row.querySelectorAll('td').forEach((cell, index) => {
                    if (index < 5) rowData.push(cell.textContent.trim());
                });
                worksheet.addRow(rowData);
            });
            
            // Auto-fit columns
            worksheet.columns.forEach(column => {
                let maxLength = 0;
                column.eachCell({ includeEmpty: true }, cell => {
                    const columnLength = cell.value ? cell.value.toString().length : 0;
                    if (columnLength > maxLength) {
                        maxLength = columnLength;
                    }
                });
                column.width = Math.min(maxLength + 2, 30);
            });
            
            // Generate Excel file
            const buffer = await workbook.xlsx.writeBuffer();
            const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            saveAs(blob, `sales_report_${new Date().toISOString().slice(0,10)}.xlsx`);
            
        } catch (error) {
            console.error("Error exporting to Excel:", error);
            alert("Error exporting to Excel: " + error.message);
        } finally {
            hideLoading();
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize sorting
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', () => {
                sortTable(header.cellIndex, header);
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('#salesTableBody tr').forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
            updateEntryInfo();
        });

        // Export to Excel
        document.getElementById('exportExcelBtn').addEventListener('click', exportToExcel);

        // Row click handler for showing product details
        document.querySelectorAll('.sale-row').forEach(row => {
            row.addEventListener('click', function(e) {
                // Don't trigger if clicking on dropdown or action elements
                if (e.target.closest('.dropdown') || 
                    e.target.closest('a') || 
                    e.target.closest('button') ||
                    e.target.tagName === 'I') {
                    return;
                }
                showProductDetails(this.dataset.saleId);
            });
        });
    });
</script>