<?php
// Include Chart.js
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>

<style>
    .chart-canvas {
        width: 100% !important;
        height: 350px !important;
        display: block;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        background: linear-gradient(135deg, #f9f9fb 0%, #f5f5fa 100%);
        transition: opacity 0.3s ease;
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

    .chart-error {
        text-align: center;
        padding: 20px;
        color: #ff3e1d;
    }

    .chart-error button {
        margin-top: 10px;
        padding: 5px 15px;
        background: #696cff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .chart-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
    }

    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    @media (max-width: 768px) {
        .chart-canvas {
            height: 250px !important;
        }
        
        .comparison-container {
            flex-direction: column;
            text-align: center;
        }
        
        .nav-pills {
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 8px;
        }
        
        .nav-item {
            flex-shrink: 0;
        }
    }

    @media (max-width: 480px) {
        .chart-canvas {
            height: 200px !important;
        }
        
        .d-flex.p-4.pt-3 {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .avatar {
            margin-bottom: 12px;
        }
    }
</style>

<div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
        <div class="">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        type="button"
                        class="nav-link active"
                        role="tab"
                        aria-selected="true"
                        aria-controls="navs-tabs-line-card-income"
                        id="tab-income"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-income">
                        Income
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        aria-selected="false"
                        aria-controls="navs-tabs-line-card-expenses"
                        id="tab-expenses"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-expenses">
                        Expenses
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        aria-selected="false"
                        aria-controls="navs-tabs-line-card-profit"
                        id="tab-profit"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-profit">
                        Profit
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body px-0">
            <div class="tab-content p-0">
                <!-- Income Tab -->
                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel" aria-labelledby="tab-income">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="../assets/img/icons/unicons/wallet.png" alt="Income icon" />
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Income</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1" id="totalIncome"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <canvas id="incomeChart" class="chart-canvas" aria-label="Income chart" role="img"></canvas>
                        <div class="chart-loading" id="incomeLoading" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center pt-4 gap-2 comparison-container">
                        <div class="flex-shrink-0">
                            <canvas id="incomeComparison" class="comparison-icon" aria-label="Income comparison"></canvas>
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
                <div class="tab-pane fade" id="navs-tabs-line-card-expenses" role="tabpanel" aria-labelledby="tab-expenses">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="../assets/img/icons/unicons/wallet.png" alt="Expenses icon" />
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Expenses</small>
                            <div class="d-flex align-items-center">
                            <h6 class="mb-0 me-1" id="totalExpenses">$<?php echo number_format($data['totalExpenses'] ?? 0, 0); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <canvas id="expensesChart" class="chart-canvas" aria-label="Expenses chart" role="img"></canvas>
                        <div class="chart-loading" id="expensesLoading" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center pt-4 gap-2 comparison-container">
                        <div class="flex-shrink-0">
                            <canvas id="expensesComparison" class="comparison-icon" aria-label="Expenses comparison"></canvas>
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
                <div class="tab-pane fade" id="navs-tabs-line-card-profit" role="tabpanel" aria-labelledby="tab-profit">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="../assets/img/icons/unicons/wallet.png" alt="Profit icon" />
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Profit</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1" id="totalProfit">$<?php echo number_format($data['totalProfit'] ?? 0, 0); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <canvas id="profitChart" class="chart-canvas" aria-label="Profit chart" role="img"></canvas>
                        <div class="chart-loading" id="profitLoading" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center pt-4 gap-2 comparison-container">
                        <div class="flex-shrink-0">
                            <canvas id="profitComparison" class="comparison-icon" aria-label="Profit comparison"></canvas>
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

<div aria-live="polite" aria-atomic="true" class="visually-hidden">
    <span id="income-update">Income data updated</span>
    <span id="expenses-update">Expenses data updated</span>
    <span id="profit-update">Profit data updated</span>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Chart instances storage
        const charts = {
            income: null,
            expenses: null,
            profit: null,
            incomeComparison: null,
            expensesComparison: null,
            profitComparison: null
        };

        // Formatting utilities
        const currencyFormatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });

        function formatFinancialValue(value) {
            const absValue = Math.abs(value);
            const sign = value < 0 ? '-' : '';
            
            if (absValue >= 1000000) {
                return `${sign}$${(absValue/1000000).toFixed(1)}M`;
            }
            if (absValue >= 1000) {
                return `${sign}$${(absValue/1000).toFixed(1)}K`;
            }
            return `${sign}${currencyFormatter.format(absValue)}`;
        }

        // Chart options
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
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
                    adapters: {
                        date: {
                            locale: 'en-US'
                        }
                    },
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    beginAtZero: false,
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
                            return formatFinancialValue(value);
                        },
                        padding: 10,
                        stepSize: 2000,
                    },
                    title: {
                        display: true,
                        text: 'Amount ($)'
                    }
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
                            return ` ${context.dataset.label}: ${formatFinancialValue(context.parsed.y)}`;
                        },
                    },
                },
                zoom: {
                    zoom: {
                        wheel: {
                            enabled: true
                        },
                        pinch: {
                            enabled: true
                        },
                        mode: 'xy'
                    },
                    pan: {
                        enabled: true,
                        mode: 'xy'
                    }
                }
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
                ctx.fillStyle = chart.data.datasets[0].backgroundColor[0];
                const percentage = Math.round(data.datasets[0].data[0]) + '%';
                ctx.fillText(percentage, xCenter, yCenter);
                ctx.restore();
            }
        };

        // Data from PHP
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

        // Process initial data to ensure consistency
        function processData(data) {
            // Ensure monthly data has all required fields
            data.monthlyData = data.monthlyData.map(item => {
                return {
                    month: item.month || '',
                    income: item.income || 0,
                    expenses: item.expenses || 0,
                    profit: (item.income || 0) - (item.expenses || 0)
                };
            });

            // Recalculate totals if they seem inconsistent
            const calculatedIncome = data.monthlyData.reduce((sum, month) => sum + month.income, 0);
            const calculatedExpenses = data.monthlyData.reduce((sum, month) => sum + month.expenses, 0);
            const calculatedProfit = calculatedIncome - calculatedExpenses;

            data.totalIncome = data.totalIncome !== undefined ? data.totalIncome : calculatedIncome;
            data.totalExpenses = data.totalExpenses !== undefined ? data.totalExpenses : calculatedExpenses;
            data.totalProfit = data.totalProfit !== undefined ? data.totalProfit : calculatedProfit;

            return data;
        }

        // Animation control based on user preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) {
            chartOptions.animation = false;
            doughnutOptions.animation = false;
        }

        // Chart creation functions
        function createGradient(ctx, chartArea, startColor, midColor, endColor) {
            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
            gradient.addColorStop(0, startColor);
            gradient.addColorStop(0.5, midColor);
            gradient.addColorStop(1, endColor);
            return gradient;
        }

        function initChart(canvasId, data) {
            try {
                const ctx = document.getElementById(canvasId);
                if (!ctx) throw new Error(`Canvas element with ID ${canvasId} not found.`);
                
                const context = ctx.getContext('2d');
                const chartType = canvasId.replace('Chart', '');
                
                if (charts[chartType]) {
                    charts[chartType].destroy();
                }
                
                charts[chartType] = new Chart(context, {
                    type: 'line',
                    data: data,
                    options: chartOptions,
                });
                
                return charts[chartType];
            } catch (error) {
                console.error(`Error initializing ${canvasId}:`, error);
                showErrorState(canvasId);
                return null;
            }
        }

        function initDoughnutChart(canvasId, percentage, color) {
            try {
                const ctx = document.getElementById(canvasId);
                if (!ctx) throw new Error(`Canvas element with ID ${canvasId} not found.`);
                
                const context = ctx.getContext('2d');
                const chartType = canvasId.replace('Comparison', '');
                
                if (charts[chartType + 'Comparison']) {
                    charts[chartType + 'Comparison'].destroy();
                }
                
                charts[chartType + 'Comparison'] = new Chart(context, {
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
                
                return charts[chartType + 'Comparison'];
            } catch (error) {
                console.error(`Error initializing ${canvasId}:`, error);
                showErrorState(canvasId);
                return null;
            }
        }

        // UI functions
        function showErrorState(canvasId) {
            const container = document.getElementById(canvasId).parentElement;
            container.innerHTML = `
                <div class="chart-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>Failed to load chart data</p>
                    <button onclick="fetchUpdatedData()">Retry</button>
                </div>
            `;
        }

        function setLoadingState(type, isLoading) {
            const canvas = document.getElementById(`${type}Chart`);
            const loadingElement = document.getElementById(`${type}Loading`);
            
            if (canvas && loadingElement) {
                canvas.style.opacity = isLoading ? 0.5 : 1;
                loadingElement.style.display = isLoading ? 'block' : 'none';
            }
        }

        // Main update function
        function updateDashboard(rawData) {
            try {
                // Process and validate the data first
                const data = processData(rawData);
                
                console.log('Processed data:', {
                    monthlyData: data.monthlyData,
                    totals: {
                        income: data.totalIncome,
                        expenses: data.totalExpenses,
                        profit: data.totalProfit
                    },
                    comparisons: data.comparisonData
                });

                // Update summary values
                document.getElementById('totalIncome').textContent = formatFinancialValue(data.totalIncome);
                document.getElementById('totalExpenses').textContent = formatFinancialValue(data.totalExpenses);
                document.getElementById('totalProfit').textContent = formatFinancialValue(data.totalProfit);

                // Update comparison texts
                document.getElementById('incomeComparisonText').textContent = 
                    `${formatFinancialValue(Math.abs(data.comparisonData.income.difference))} ` + 
                    (data.comparisonData.income.difference >= 0 ? 'more than last month' : 'less than last month');
                
                document.getElementById('expensesComparisonText').textContent = 
                    `${formatFinancialValue(Math.abs(data.comparisonData.expenses.difference))} ` + 
                    (data.comparisonData.expenses.difference >= 0 ? 'more than last month' : 'less than last month');
                
                document.getElementById('profitComparisonText').textContent = 
                    `${formatFinancialValue(Math.abs(data.comparisonData.profit.difference))} ` + 
                    (data.comparisonData.profit.difference >= 0 ? 'more than last month' : 'less than last month');

                // Get months for chart labels
                const months = data.monthlyData.map(item => item.month);
                const activeTab = document.querySelector('.tab-pane.show.active').id;
                
                // Function to initialize main charts
                const initMainChart = (type, color) => {
                    initChart(`${type}Chart`, {
                        labels: months,
                        datasets: [{
                            label: type.charAt(0).toUpperCase() + type.slice(1),
                            data: data.monthlyData.map(item => item[type]),
                            borderColor: color,
                            pointBackgroundColor: color,
                            backgroundColor: function(context) {
                                const chart = context.chart;
                                const { ctx, chartArea } = chart;
                                if (!chartArea) return;
                                return createGradient(ctx, chartArea, 
                                    `${color}0D`, // 5% opacity
                                    `${color}33`, // 20% opacity
                                    `${color}4D`  // 30% opacity
                                );
                            },
                            fill: true,
                            tension: 0.4,
                        }]
                    });
                };

                // Update charts based on active tab
                if (activeTab === 'navs-tabs-line-card-income') {
                    initMainChart('income', '#696cff');
                    initDoughnutChart('incomeComparison', data.comparisonData.income.percentage, '#696cff');
                    document.getElementById('income-update').textContent = `Income data updated at ${new Date().toLocaleTimeString()}`;
                } 
                else if (activeTab === 'navs-tabs-line-card-expenses') {
                    initMainChart('expenses', '#ff3e1d');
                    initDoughnutChart('expensesComparison', data.comparisonData.expenses.percentage, '#ff3e1d');
                    document.getElementById('expenses-update').textContent = `Expenses data updated at ${new Date().toLocaleTimeString()}`;
                } 
                else if (activeTab === 'navs-tabs-line-card-profit') {
                    initMainChart('profit', '#71dd37');
                    initDoughnutChart('profitComparison', data.comparisonData.profit.percentage, '#71dd37');
                    document.getElementById('profit-update').textContent = `Profit data updated at ${new Date().toLocaleTimeString()}`;
                }

                // Store the updated data
                monthlyData = data.monthlyData;
                totalIncome = data.totalIncome;
                totalExpenses = data.totalExpenses;
                totalProfit = data.totalProfit;
                comparisonData = data.comparisonData;
                currentYear = data.currentYear || new Date().getFullYear();

            } catch (error) {
                console.error('Dashboard update failed:', error);
                ['income', 'expenses', 'profit'].forEach(type => {
                    showErrorState(`${type}Chart`);
                });
            }
        }

        // Data fetching with debouncing
        let isFetching = false;
        async function fetchUpdatedData() {
            if (isFetching) return;
            isFetching = true;
            
            try {
                // Set loading states
                ['income', 'expenses', 'profit'].forEach(type => {
                    setLoadingState(type, true);
                });
                
                const response = await fetch('/expense-overview/get-updated-data', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    cache: 'no-cache'
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                if (data.success) {
                    console.log('Fetched updated data:', data);
                    updateDashboard(data);
                } else {
                    throw new Error(data.message || 'Failed to fetch updated data');
                }
            } catch (error) {
                console.error('Error fetching updated data:', error);
                ['income', 'expenses', 'profit'].forEach(type => {
                    showErrorState(`${type}Chart`);
                });
            } finally {
                isFetching = false;
                ['income', 'expenses', 'profit'].forEach(type => {
                    setLoadingState(type, false);
                });
            }
        }

        // Tab switching handler
        document.querySelector('.nav-pills').addEventListener('click', (event) => {
            const tab = event.target.closest('.nav-link');
            if (!tab) return;
            
            const target = tab.getAttribute('data-bs-target');
            
            if (target === '#navs-tabs-line-card-income') {
                initChart('incomeChart', {
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
                
                initDoughnutChart('incomeComparison', comparisonData.income.percentage, '#696cff');
            } 
            else if (target === '#navs-tabs-line-card-expenses') {
                initChart('expensesChart', {
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
                
                initDoughnutChart('expensesComparison', comparisonData.expenses.percentage, '#ff3e1d');
            } 
            else if (target === '#navs-tabs-line-card-profit') {
                initChart('profitChart', {
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
                
                initDoughnutChart('profitComparison', comparisonData.profit.percentage, '#71dd37');
            }
        });

        // Year change detection
        let lastKnownYear = currentYear;
        function checkYearChange() {
            const currentYearNow = new Date().getFullYear();
            if (currentYearNow !== lastKnownYear) {
                console.log('Year has changed from', lastKnownYear, 'to', currentYearNow);
                lastKnownYear = currentYearNow;
                fetchUpdatedData();
            }
        }

        // Initial setup with processed data
        updateDashboard({
            monthlyData: monthlyData,
            totalIncome: totalIncome,
            totalExpenses: totalExpenses,
            totalProfit: totalProfit,
            comparisonData: comparisonData,
            currentYear: currentYear
        });

        // Set up periodic checks
        setInterval(checkYearChange, 300000); // Check every 5 minutes
        setInterval(fetchUpdatedData, 30000); // Update every 30 seconds
        
        // Initial fetch
        fetchUpdatedData();
    });
</script>