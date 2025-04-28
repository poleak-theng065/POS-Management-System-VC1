<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
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
                                <a class="dropdown-item" href="/sold_product">View Details</a>
                                <a class="dropdown-item" href="#" onclick="handleRefresh(event)">Refresh</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Profit</span>
                    <div class="value text-dark" style="font-size: 1.2rem;" id="totalProfit">
                        $<?= number_format($totalProfit ?? 0, 0) ?>
                    </div>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Current Month</small>
                </div>
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="col-6 col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="Expenses Icon" class="rounded" />
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/sold_product">View Details</a>
                                <a class="dropdown-item" href="#" onclick="handleRefresh(event)">Refresh</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Expenses</span>
                    <div class="value text-dark" style="font-size: 1.2rem;" id="totalExpenses">
                        $<?= number_format($totalExpenses ?? 0, 0) ?>
                    </div>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Current Month</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function fetchUpdatedData() {
            fetch('/_totalSold', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Fetched Updated Data:', data);
                if (data.success) {
                    document.getElementById('totalProfit').textContent = `$${Number(data.totalProfit).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
                    document.getElementById('totalExpenses').textContent = `$${Number(data.totalExpenses).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
                } else {
                    console.error('Failed to fetch updated data:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching updated data:', error);
            });
        }

        let lastKnownMonth = <?php echo date('m'); ?>;
        function checkMonthChange() {
            const currentMonth = new Date().getMonth() + 1; // getMonth() is 0-11, so add 1
            if (currentMonth !== lastKnownMonth) {
                console.log('Month has changed from', lastKnownMonth, 'to', currentMonth);
                lastKnownMonth = currentMonth;
                fetchUpdatedData();
            }
        }

        // Function to handle page refresh
        window.handleRefresh = function(event) {
            event.preventDefault(); // Prevent default link behavior
            window.location.reload(); // Reload the page
        };

        setInterval(checkMonthChange, 300000); // Check every 5 minutes
        setInterval(fetchUpdatedData, 30000); // Update every 30 seconds
        fetchUpdatedData();
    });
</script>