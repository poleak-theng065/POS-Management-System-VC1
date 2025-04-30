<div class="col-md-6 col-lg-4 mb-4">
    <div class="card shadow-sm h-100 border-0 rounded-4 bg-glass">
        <div class="d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
                <h5 class="m-0 me-2">Category</h5>
            </div>
            <div class="dropdown">
                <button
                    class="btn p-0"
                    type="button"
                    id="orederStatistics"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="/product_list">View Details</a>
                    <a class="dropdown-item" href="#" onclick="handleRefresh(event)">Refresh</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="text-center mb-4">
                <h2 id="totalProducts" class="display-6 fw-bold text-primary"><?= number_format($totalProducts ?? 0, 0) ?></h2>
                <small class="text-muted">Total Products in Stock</small>
            </div>

            <ul class="list-unstyled" id="categoryList">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <?php
                        $percentage = $totalProducts > 0 ? ($category['total_quantity'] / $totalProducts) * 100 : 0;
                        $progressClass = $category['total_quantity'] > 0 ? 'bg-success' : 'bg-secondary';
                        $quantityClass = $category['total_quantity'] > 0 ? 'text-success' : 'text-muted';
                        $percentageFormatted = number_format($percentage, 1);
                        ?>
                        <li class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0"><?= htmlspecialchars($category['name']) ?></h6>
                                <div class="text-end">
                                    <small class="fw-semibold <?= $quantityClass ?>" data-bs-toggle="tooltip" title="<?= $percentageFormatted ?>%">
                                        <?= number_format($category['total_quantity'], 0) ?>
                                    </small>
                                    <small class="text-muted ms-2"><?= $percentageFormatted ?>%</small>
                                </div>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar <?= $progressClass ?>" role="progressbar" style="width: <?= $percentage ?>%;" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="text-center text-muted py-3">No categories found</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>