<?php
// Include Chart.js
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .chart-canvas {
        width: 100% !important;
        height: 350px !important;
        display: block;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        background: linear-gradient(135deg, #f9f9fb 0%, #f5f5fa 100%);
    }

    .card-body {
        padding: 1.5rem !important;
    }

    .tab-content {
        padding: 0 !important;
    }

    .card {
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        background: #fff;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.show {
        display: block;
    }

    .nav-link {
        font-weight: 600;
        color: #6c757d;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .nav-link.active {
        background-color: #696cff !important;
        color: white !important;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(105, 108, 255, 0.3);
    }

    .nav-link:hover {
        color: #696cff;
    }

    .card-header {
        background: none;
        border-bottom: none;
        padding-bottom: 0;
    }

    .d-flex.align-items-center {
        margin-bottom: 1rem;
    }

    .avatar img {
        width: 40px;
        height: 40px;
    }

    .text-muted {
        font-size: 0.85rem;
    }

    .text-success, .text-danger {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .comparison-icon {
        width: 60px !important;
        height: 60px !important;
    }

    .comparison-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .comparison-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>

<div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
        <div class="">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <button
                        type="button"
                        class="nav-link active"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-income"
                        aria-controls="navs-tabs-line-card-income"
                        aria-selected="true">
                        Income
                    </button>
                </li>
                <li class="nav-item">
                    <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-expenses"
                        aria-controls="navs-tabs-line-card-expenses"
                        aria-selected="false">
                        Expenses
                    </button>
                </li>
                <li class="nav-item">
                    <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-profit"
                        aria-controls="navs-tabs-line-card-profit"
                        aria-selected="false">
                        Profit
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body px-0">
            <div class="tab-content p-0">
                <!-- Income Tab -->
                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Income</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1" id="totalIncome">$<?php echo number_format($data['totalIncome'] ?? 0, 0); ?></h6>
                            </div>
                        </div>
                    </div>
                    <canvas id="incomeChart" class="chart-canvas"></canvas>
                    <div class="d-flex justify-content-center pt-4 gap-2 comparison-container">
                        <div class="flex-shrink-0">
                            <canvas id="incomeComparison" class="comparison-icon"></canvas>
                        </div>
                        <div class="comparison-text">
                            <p class="mb-n1 mt-1">Income This Month</p>
                            <small class="text-muted" id="incomeComparisonText">
                                $<?php echo number_format(abs($data['comparisonData']['income']['difference'] ?? 0), 0); ?> 
                                <?php echo ($data['comparisonData']['income']['difference'] ?? 0) >= 0 ? 'more than last month' : 'less than last month'; ?>
                            </small>
                        </div>
                    </div>
                </div>
                <!-- Expenses Tab -->
                <div class="tab-pane fade" id="navs-tabs-line-card-expenses" role="tabpanel">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Expenses</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1" id="totalExpenses">$<?php echo number_format($data['totalExpenses'] ?? 0, 0); ?></h6>
                            </div>
                        </div>
                    </div>
                    <canvas id="expensesChart" class="chart-canvas"></canvas>
                    <div class="d-flex justify-content-center pt-4 gap-2 comparison-container">
                        <div class="flex-shrink-0">
                            <canvas id="expensesComparison" class="comparison-icon"></canvas>
                        </div>
                        <div class="comparison-text">
                            <p class="mb-n1 mt-1">Expenses This Month</p>
                            <small class="text-muted" id="expensesComparisonText">
                                $<?php echo number_format(abs($data['comparisonData']['expenses']['difference'] ?? 0), 0); ?> 
                                <?php echo ($data['comparisonData']['expenses']['difference'] ?? 0) >= 0 ? 'more than last month' : 'less than last month'; ?>
                            </small>
                        </div>
                    </div>
                </div>
                <!-- Profit Tab -->
                <div class="tab-pane fade" id="navs-tabs-line-card-profit" role="tabpanel">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Profit</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1" id="totalProfit">$<?php echo number_format($data['totalProfit'] ?? 0, 0); ?></h6>
                            </div>
                        </div>
                    </div>
                    <canvas id="profitChart" class="chart-canvas"></canvas>
                    <div class="d-flex justify-content-center pt-4 gap-2 comparison-container">
                        <div class="flex-shrink-0">
                            <canvas id="profitComparison" class="comparison-icon"></canvas>
                        </div>
                        <div class="comparison-text">
                            <p class="mb-n1 mt-1">Profit This Month</p>
                            <small class="text-muted" id="profitComparisonText">
                                $<?php echo number_format(abs($data['comparisonData']['profit']['difference'] ?? 0), 0); ?> 
                                <?php echo ($data['comparisonData']['profit']['difference'] ?? 0) >= 0 ? 'more than last month' : 'less than last month'; ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "'Public Sans', sans-serif",
                            weight: '500',
                        },
                        color: '#6c757d',
                        maxRotation: 45,
                        minRotation: 45,
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [5, 5],
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false,
                    },
                    ticks: {
                        display: true,
                        font: {
                            size: 12,
                            family: "'Public Sans', sans-serif",
                            weight: '500',
                        },
                        color: '#6c757d',
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        },
                        padding: 10,
                        stepSize: 2000, // Adjusted for values like $9,100
                    },
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.85)',
                    titleFont: {
                        family: "'Public Sans', sans-serif",
                        size: 14,
                        weight: '600',
                    },
                    bodyFont: {
                        family: "'Public Sans', sans-serif",
                        size: 12,
                    },
                    padding: 10,
                    cornerRadius: 6,
                    boxPadding: 4,
                    callbacks: {
                        label: function(context) {
                            return ` ${context.dataset.label}: $${context.parsed.y.toLocaleString()}`;
                        },
                    },
                },
            },
            elements: {
                line: {
                    borderWidth: 3,
                    tension: 0.4,
                    shadowOffsetX: 0,
                    shadowOffsetY: 4,
                    shadowBlur: 10,
                    shadowColor: 'rgba(0, 0, 0, 0.1)',
                },
                point: {
                    radius: 5,
                    hoverRadius: 8,
                    borderColor: '#fff',
                    borderWidth: 2,
                    hoverBorderWidth: 3,
                },
            },
            animation: {
                duration: 1200,
                easing: 'easeInOutQuart',
            },
        };

        const doughnutOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '80%',
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: false,
                },
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart',
            },
        };

        // Plugin to display percentage inside the doughnut chart
        const doughnutLabelPlugin = {
            id: 'doughnutLabel',
            afterDatasetsDraw(chart) {
                const { ctx, data } = chart;
                ctx.save();
                const xCenter = chart.getDatasetMeta(0).data[0].x;
                const yCenter = chart.getDatasetMeta(0).data[0].y;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.font = 'bold 12px Public Sans, sans-serif';
                ctx.fillStyle = chart.data.datasets[0].backgroundColor[0]; // Match the color of the progress
                const percentage = Math.round(data.datasets[0].data[0]) + '%';
                ctx.fillText(percentage, xCenter, yCenter);
                ctx.restore();
            }
        };

        let monthlyData = <?php echo json_encode($data['monthlyData'] ?? []); ?>;
        let totalIncome = <?php echo json_encode($data['totalIncome'] ?? 0); ?>;
        let totalExpenses = <?php echo json_encode($data['totalExpenses'] ?? 0); ?>;
        let totalProfit = <?php echo json_encode($data['totalProfit'] ?? 0); ?>;
        let comparisonData = <?php echo json_encode($data['comparisonData'] ?? [
            'income' => ['percentage' => 0, 'difference' => 0],
            'expenses' => ['percentage' => 0, 'difference' => 0],
            'profit' => ['percentage' => 0, 'difference' => 0]
        ]); ?>;
        let currentYear = <?php echo json_encode($data['currentYear'] ?? date('Y')); ?>;

        let incomeChart, expensesChart, profitChart;
        let incomeComparisonChart, expensesComparisonChart, profitComparisonChart;

        function createGradient(ctx, chartArea, startColor, midColor, endColor) {
            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
            gradient.addColorStop(0, startColor);
            gradient.addColorStop(0.5, midColor);
            gradient.addColorStop(1, endColor);
            return gradient;
        }

        function initChart(chartVar, canvasId, data) {
            const ctx = document.getElementById(canvasId);
            if (!ctx) {
                console.error(`Canvas element with ID ${canvasId} not found.`);
                return null;
            }
            const context = ctx.getContext('2d');
            if (chartVar) {
                chartVar.destroy();
            }
            return new Chart(context, {
                type: 'line',
                data: data,
                options: chartOptions,
            });
        }

        function initDoughnutChart(chartVar, canvasId, percentage, color) {
            const ctx = document.getElementById(canvasId);
            if (!ctx) {
                console.error(`Canvas element with ID ${canvasId} not found.`);
                return null;
            }
            const context = ctx.getContext('2d');
            if (chartVar) {
                chartVar.destroy();
            }
            return new Chart(context, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [Math.abs(percentage), 100 - Math.abs(percentage)],
                        backgroundColor: [color, 'rgba(0, 0, 0, 0.1)'],
                        borderWidth: 0,
                    }]
                },
                options: doughnutOptions,
                plugins: [doughnutLabelPlugin]
            });
        }

        function updateDashboard(data) {
            console.log('Updating Dashboard with:', data);
            document.getElementById('totalIncome').textContent = `$${Number(data.totalIncome).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
            document.getElementById('totalExpenses').textContent = `$${Number(data.totalExpenses).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
            document.getElementById('totalProfit').textContent = `$${Number(data.totalProfit).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;

            const months = data.monthlyData.map(item => item.month);
            const incomeValues = data.monthlyData.map(item => item.income);
            const expensesValues = data.monthlyData.map(item => item.expenses);
            const profitValues = data.monthlyData.map(item => item.profit);

            console.log('Updated Income Values:', incomeValues);
            console.log('Updated Expenses Values:', expensesValues);
            console.log('Updated Profit Values:', profitValues);

            const incomeData = {
                labels: months,
                datasets: [{
                    label: 'Income',
                    data: incomeValues,
                    borderColor: '#696cff',
                    pointBackgroundColor: '#696cff',
                    backgroundColor: function(context) {
                        const chart = context.chart;
                        const { ctx, chartArea } = chart;
                        if (!chartArea) return;
                        return createGradient(ctx, chartArea, 'rgba(105, 108, 255, 0.05)', 'rgba(105, 108, 255, 0.2)', 'rgba(105, 108, 255, 0.5)');
                    },
                    fill: true,
                    tension: 0.4,
                }]
            };

            const expensesData = {
                labels: months,
                datasets: [{
                    label: 'Expenses',
                    data: expensesValues,
                    borderColor: '#ff3e1d',
                    pointBackgroundColor: '#ff3e1d',
                    backgroundColor: function(context) {
                        const chart = context.chart;
                        const { ctx, chartArea } = chart;
                        if (!chartArea) return;
                        return createGradient(ctx, chartArea, 'rgba(255, 62, 29, 0.05)', 'rgba(255, 62, 29, 0.2)', 'rgba(255, 62, 29, 0.5)');
                    },
                    fill: true,
                    tension: 0.4,
                }]
            };

            const profitData = {
                labels: months,
                datasets: [{
                    label: 'Profit',
                    data: profitValues,
                    borderColor: '#71dd37',
                    pointBackgroundColor: '#71dd37',
                    backgroundColor: function(context) {
                        const chart = context.chart;
                        const { ctx, chartArea } = chart;
                        if (!chartArea) return;
                        return createGradient(ctx, chartArea, 'rgba(113, 221, 55, 0.05)', 'rgba(113, 221, 55, 0.2)', 'rgba(113, 221, 55, 0.5)');
                    },
                    fill: true,
                    tension: 0.4,
                }]
            };

            // Update comparison texts
            document.getElementById('incomeComparisonText').textContent = 
                `$${Math.abs(data.comparisonData.income.difference).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})} ` + 
                (data.comparisonData.income.difference >= 0 ? 'more than last month' : 'less than last month');
            document.getElementById('expensesComparisonText').textContent = 
                `$${Math.abs(data.comparisonData.expenses.difference).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})} ` + 
                (data.comparisonData.expenses.difference >= 0 ? 'more than last month' : 'less than last month');
            document.getElementById('profitComparisonText').textContent = 
                `$${Math.abs(data.comparisonData.profit.difference).toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})} ` + 
                (data.comparisonData.profit.difference >= 0 ? 'more than last month' : 'less than last month');

            // Initialize comparison charts
            incomeComparisonChart = initDoughnutChart(incomeComparisonChart, 'incomeComparison', data.comparisonData.income.percentage, '#696cff');
            expensesComparisonChart = initDoughnutChart(expensesComparisonChart, 'expensesComparison', data.comparisonData.expenses.percentage, '#ff3e1d');
            profitComparisonChart = initDoughnutChart(profitComparisonChart, 'profitComparison', data.comparisonData.profit.percentage, '#71dd37');

            const activeTab = document.querySelector('.tab-pane.show.active').id;
            console.log('Active Tab:', activeTab);
            if (activeTab === 'navs-tabs-line-card-income') {
                incomeChart = initChart(incomeChart, 'incomeChart', incomeData);
            } else if (activeTab === 'navs-tabs-line-card-expenses') {
                expensesChart = initChart(expensesChart, 'expensesChart', expensesData);
            } else if (activeTab === 'navs-tabs-line-card-profit') {
                profitChart = initChart(profitChart, 'profitChart', profitData);
            }
        }

        updateDashboard({
            monthlyData: monthlyData,
            totalIncome: totalIncome,
            totalExpenses: totalExpenses,
            totalProfit: totalProfit,
            comparisonData: comparisonData
        });

        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((tab) => {
            tab.addEventListener('shown.bs.tab', function (event) {
                const target = event.target.getAttribute('data-bs-target');
                if (target === '#navs-tabs-line-card-income') {
                    incomeChart = initChart(incomeChart, 'incomeChart', {
                        labels: monthlyData.map(item => item.month),
                        datasets: [{
                            label: 'Income',
                            data: monthlyData.map(item => item.income),
                            borderColor: '#696cff',
                            pointBackgroundColor: '#696cff',
                            backgroundColor: function(context) {
                                const chart = context.chart;
                                const { ctx, chartArea } = chart;
                                if (!chartArea) return;
                                return createGradient(ctx, chartArea, 'rgba(105, 108, 255, 0.05)', 'rgba(105, 108, 255, 0.2)', 'rgba(105, 108, 255, 0.5)');
                            },
                            fill: true,
                            tension: 0.4,
                        }]
                    });
                    incomeComparisonChart = initDoughnutChart(incomeComparisonChart, 'incomeComparison', comparisonData.income.percentage, '#696cff');
                } else if (target === '#navs-tabs-line-card-expenses') {
                    expensesChart = initChart(expensesChart, 'expensesChart', {
                        labels: monthlyData.map(item => item.month),
                        datasets: [{
                            label: 'Expenses',
                            data: monthlyData.map(item => item.expenses),
                            borderColor: '#ff3e1d',
                            pointBackgroundColor: '#ff3e1d',
                            backgroundColor: function(context) {
                                const chart = context.chart;
                                const { ctx, chartArea } = chart;
                                if (!chartArea) return;
                                return createGradient(ctx, chartArea, 'rgba(255, 62, 29, 0.05)', 'rgba(255, 62, 29, 0.2)', 'rgba(255, 62, 29, 0.5)');
                            },
                            fill: true,
                            tension: 0.4,
                        }]
                    });
                    expensesComparisonChart = initDoughnutChart(expensesComparisonChart, 'expensesComparison', comparisonData.expenses.percentage, '#ff3e1d');
                } else if (target === '#navs-tabs-line-card-profit') {
                    profitChart = initChart(profitChart, 'profitChart', {
                        labels: monthlyData.map(item => item.month),
                        datasets: [{
                            label: 'Profit',
                            data: monthlyData.map(item => item.profit),
                            borderColor: '#71dd37',
                            pointBackgroundColor: '#71dd37',
                            backgroundColor: function(context) {
                                const chart = context.chart;
                                const { ctx, chartArea } = chart;
                                if (!chartArea) return;
                                return createGradient(ctx, chartArea, 'rgba(113, 221, 55, 0.05)', 'rgba(113, 221, 55, 0.2)', 'rgba(113, 221, 55, 0.5)');
                            },
                            fill: true,
                            tension: 0.4,
                        }]
                    });
                    profitComparisonChart = initDoughnutChart(profitComparisonChart, 'profitComparison', comparisonData.profit.percentage, '#71dd37');
                }
            });
        });

        function fetchUpdatedData() {
            fetch('/expense-overview/get-updated-data', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('AJAX Response:', data);
                if (data.success) {
                    console.log('Fetched Updated Data:', data);
                    monthlyData = data.monthlyData;
                    totalIncome = data.totalIncome;
                    totalExpenses = data.totalExpenses;
                    totalProfit = data.totalProfit;
                    comparisonData = data.comparisonData;
                    currentYear = data.currentYear;
                    updateDashboard(data);
                } else {
                    console.error('Failed to fetch updated data:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching updated data:', error);
            });
        }

        let lastKnownYear = currentYear;
        function checkYearChange() {
            const currentYearNow = new Date().getFullYear();
            if (currentYearNow !== lastKnownYear) {
                console.log('Year has changed from', lastKnownYear, 'to', currentYearNow);
                lastKnownYear = currentYearNow;
                fetchUpdatedData();
            }
        }

        setInterval(checkYearChange, 300000); // Check every 5 minutes
        setInterval(fetchUpdatedData, 30000); // Update every 30 seconds
        fetchUpdatedData();
    });
</script>