<?php
// Include Chart.js
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .chart-canvas {
        width: 100% !important;
        height: 300px !important;
        display: block;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
        border: 1px solid rgba(0, 0, 0, 0.01);
    }

    .card-body {
        padding: 1rem !important;
    }

    .card {
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        border: none;
        background: #fff;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background: none;
        border-bottom: none;
        padding: 0.75rem 1rem 0;
    }

    .card-header h5 {
        color: #1e293b;
        font-weight: 600;
        font-size: 1.1rem;
        margin: 0;
    }

    .text-muted {
        font-size: 0.75rem;
        color: #64748b;
    }
</style>

<div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
        <div class="">
            <h5 class="m-0 me-2">Revenue Report</h5>
        </div>
        <div class="card-body px-0">
            <canvas id="revenueChart" class="chart-canvas"></canvas>
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
                            size: 10,
                            family: "'Public Sans', sans-serif",
                            weight: '500',
                        },
                        color: '#64748b',
                        maxRotation: 45,
                        minRotation: 45,
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [3, 3],
                        color: 'rgba(0, 0, 0, 0.03)',
                        drawBorder: false,
                    },
                    ticks: {
                        display: true,
                        font: {
                            size: 10,
                            family: "'Public Sans', sans-serif",
                            weight: '500',
                        },
                        color: '#64748b',
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        },
                        padding: 6,
                        stepSize: 2000, // Adjusted for revenue values
                    },
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.9)',
                    titleFont: {
                        family: "'Public Sans', sans-serif",
                        size: 11,
                        weight: '600',
                    },
                    bodyFont: {
                        family: "'Public Sans', sans-serif",
                        size: 9,
                    },
                    padding: 6,
                    cornerRadius: 4,
                    boxPadding: 3,
                    callbacks: {
                        label: function(context) {
                            return ` ${context.dataset.label}: $${context.parsed.y.toLocaleString()}`;
                        },
                    },
                },
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4,
                },
                point: {
                    radius: 3,
                    hoverRadius: 6,
                    borderColor: '#fff',
                    borderWidth: 1,
                    hoverBorderWidth: 2,
                },
            },
            animation: {
                duration: 800,
                easing: 'easeInOutQuart',
            },
        };

        let monthlyData = <?php echo json_encode($data['monthlyData'] ?? []); ?>;
        let totalRevenue = <?php echo json_encode($data['totalRevenue'] ?? 0); ?>;
        let currentYear = <?php echo json_encode($data['currentYear'] ?? date('Y')); ?>;

        let revenueChart;

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

        function updateDashboard(data) {
            console.log('Updating Dashboard with:', data);
            const totalRevenueElement = document.getElementById('totalRevenue');
            if (totalRevenueElement) {
                const revenueValue = Number(data.totalRevenue);
                totalRevenueElement.textContent = `$${isNaN(revenueValue) ? '0' : revenueValue.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
            }

            const months = data.monthlyData.map(item => item.month);
            const revenueValues = data.monthlyData.map(item => item.revenue);

            console.log('Updated Revenue Values:', revenueValues);

            const revenueData = {
                labels: months,
                datasets: [{
                    label: 'Revenue',
                    data: revenueValues,
                    borderColor: '#7c3aed',
                    pointBackgroundColor: '#7c3aed',
                    backgroundColor: function(context) {
                        const chart = context.chart;
                        const { ctx, chartArea } = chart;
                        if (!chartArea) return;
                        return createGradient(ctx, chartArea, 'rgba(124, 58, 237, 0.05)', 'rgba(124, 58, 237, 0.2)', 'rgba(124, 58, 237, 0.5)');
                    },
                    fill: true,
                    tension: 0.4,
                }]
            };

            revenueChart = initChart(revenueChart, 'revenueChart', revenueData);
        }

        updateDashboard({
            monthlyData: monthlyData,
            totalRevenue: totalRevenue
        });

        function fetchUpdatedData() {
            fetch('/total-revenue/get-updated-data', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('AJAX Response:', data);
                if (data.success) {
                    console.log('Fetched Updated Data:', data);
                    monthlyData = data.monthlyData;
                    totalRevenue = data.totalRevenue;
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