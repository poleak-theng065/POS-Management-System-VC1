<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
        <!-- Total Sold -->
        <!-- <div class="col-12 col-lg-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart.png" alt="Total Sold Icon" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">View Details</a>
                                <a class="dropdown-item" href="#">Refresh</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Sold</span>
                    <div class="value text-dark" style="font-size: 1.2rem;">
                        <?= number_format($totalQuantitySold ?? 0) ?> units
                    </div>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> All Time</small>
                </div>
            </div>
        </div> -->

        <!-- Total Profit -->
        <div class="col-6 col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="Profit Icon" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">View Details</a>
                                <a class="dropdown-item" href="#">Refresh</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Profit</span>
                    <div class="value text-dark" style="font-size: 1.2rem;">
                        $<?= number_format($totalProfit ?? 0, 2) ?>
                    </div>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Current Month</small>
                </div>
            </div>
        </div>

        <!-- Total Cost Price -->
        <div class="col-6 col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="Cost Price Icon" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">View Details</a>
                                <a class="dropdown-item" href="#">Refresh</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Cost</span>
                    <div class="value text-dark" style="font-size: 1.2rem;">
                        $<?= number_format($totalCostPrice ?? 0, 2) ?>
                    </div>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Current Month</small>
                </div>
            </div>
        </div>
    </div>
</div>