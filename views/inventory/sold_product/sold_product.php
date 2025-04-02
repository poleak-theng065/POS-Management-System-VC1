<style>
    /* th.sortable {
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
    } */

    /*  */
    .table td {
        vertical-align: middle;
        text-align: left; /* Align text to the start */
    }

    .table td:nth-child(2) {
        display: flex;
        align-items: center;
    }
</style>

<div class="container mt-4">
    
    <h1 class="fw-bold px-4 py-3 rounded shadow-sm d-inline-block"
        style="border-left: 8px solid #198754; background-color: #f8f9fa;">
        <i class="bi bi-cart-check text-success me-2"></i> Sales List - Sold Items
    </h1>

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

    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Product</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($saleItems as $saleItem): ?>
                        <tr>
                            <td><?= $saleItem['barcode'] ?></td>
                            <td>
                                <img src="<?= !empty($saleItem['image_path']) ? 'assets/img/upload/' . $saleItem['image_path'] : '/path/to/default/image.png' ?>"
                                    alt="Product Image" width="50" height="50" style="object-fit: cover; border-radius: 5px; margin-right: 10px;"> <!-- Added margin-right -->
                                <?= $saleItem['name'] ?>
                            </td>
                            <td><?= $saleItem['brand'] ?></td>
                            <td><?= $saleItem['quantity'] ?></td>
                            <td><?= $saleItem['discount'] ?></td>
                        </tr>
                    <?php endforeach; ?>
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