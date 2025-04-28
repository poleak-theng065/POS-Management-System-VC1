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

    .profit-report-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
        padding: 0 1rem;
    }

    .chart-container {
        width: 100%;
        padding: 0 1rem;
    }
</style>

<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="">
                    <h5 class="m-0 me-2">Profit Report</h5>
                </div>
                <div class="card-body px-0">
                    <canvas id="profitReportChart" class="chart-canvas"></canvas>
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
                        stepSize: 1000, // Adjusted for smaller profit values
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
        let totalProfitReport = <?php echo json_encode($data['totalProfitReport'] ?? 0); ?>;
        let currentYear = <?php echo json_encode($data['currentYear'] ?? date('Y')); ?>;

        let profitReportChart;

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
            console.log('Updating Profit Report Dashboard with:', data);
            const totalProfitReportElement = document.getElementById('totalProfitReport');
            if (totalProfitReportElement) {
                const profitValue = Number(data.totalProfitReport);
                totalProfitReportElement.textContent = `$${isNaN(profitValue) ? '0' : profitValue.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
            }

            const months = data.monthlyData.map(item => item.month);
            const profitReportValues = data.monthlyData.map(item => item.profit);

            console.log('Updated Profit Report Values:', profitReportValues);

            const profitReportData = {
                labels: months,
                datasets: [{
                    label: 'Profit Report',
                    data: profitReportValues,
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

            profitReportChart = initChart(profitReportChart, 'profitReportChart', profitReportData);
        }

        updateDashboard({
            monthlyData: monthlyData,
            totalProfitReport: totalProfitReport
        });

        function fetchUpdatedData() {
            fetch('/total-profit-report/get-updated-data', {
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
                console.log('AJAX Response for Profit Report:', data);
                if (data.success) {
                    console.log('Fetched Updated Profit Report Data:', data);
                    monthlyData = data.monthlyData;
                    totalProfitReport = data.totalProfitReport;
                    currentYear = data.currentYear;
                    updateDashboard(data);
                } else {
                    console.error('Failed to fetch updated profit report data:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching updated profit report data:', error);
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