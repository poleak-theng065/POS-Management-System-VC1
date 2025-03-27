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

<div class="container mt-4">
    <h1>Sales List</h1>
    <div class="card p-5 bg-white shadow-lg border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="productTable">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($saleItems as $saleItem): ?>
                        <tr>
                            <td><?= $saleItem['barcode'] ?></td>
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