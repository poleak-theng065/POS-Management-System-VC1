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

        .card-header h5 {
            color: #1e293b;
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
            padding: 0.75rem 1rem 0;
        }

        .text-muted {
            font-size: 0.75rem;
            color: #64748b;
        }
    </style>


<div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
        <div class="card-header">
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
                    grid: { display: false },
                    ticks: {
                        font: { size: 10, family: "'Public Sans', sans-serif", weight: '500' },
                        color: '#64748b',
                        maxRotation: 45,
                        minRotation: 45
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [3, 3],
                        color: 'rgba(0, 0, 0, 0.03)',
                        drawBorder: false
                    },
                    ticks: {
                        display: true,
                        font: { size: 10, family: "'Public Sans', sans-serif", weight: '500' },
                        color: '#64748b',
                        callback: value => '$' + value.toLocaleString(),
                        padding: 6,
                        stepSize: 2000
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.9)',
                    titleFont: { family: "'Public Sans', sans-serif", size: 11, weight: '600' },
                    bodyFont: { family: "'Public Sans', sans-serif", size: 9 },
                    padding: 6,
                    cornerRadius: 4,
                    boxPadding: 3,
                    callbacks: {
                        label: context => ` ${context.dataset.label}: $${context.parsed.y.toLocaleString()}`
                    }
                }
            },
            elements: {
                line: { borderWidth: 2, tension: 0.4 },
                point: {
                    radius: 3, hoverRadius: 6,
                    borderColor: '#fff', borderWidth: 1, hoverBorderWidth: 2
                }
            },
            animation: { duration: 800, easing: 'easeInOutQuart' }
        };

        // Hardcoded data (or fetch this dynamically)
        let monthlyData = [
            { month: 'Jan', revenue: 12000 },
            { month: 'Feb', revenue: 15000 },
            { month: 'Mar', revenue: 11000 },
            { month: 'Apr', revenue: 17000 },
            { month: 'May', revenue: 20000 },
            { month: 'Jun', revenue: 19000 },
            { month: 'Jul', revenue: 23000 },
            { month: 'Aug', revenue: 21000 },
            { month: 'Sep', revenue: 25000 },
            { month: 'Oct', revenue: 22000 },
            { month: 'Nov', revenue: 30000 },
            { month: 'Dec', revenue: 28000 }
        ];
        let totalRevenue = monthlyData.reduce((sum, m) => sum + m.revenue, 0);
        let currentYear = new Date().getFullYear();

        let revenueChart;

        function createGradient(ctx, chartArea, startColor, midColor, endColor) {
            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
            gradient.addColorStop(0, startColor);
            gradient.addColorStop(0.5, midColor);
            gradient.addColorStop(1, endColor);
            return gradient;
        }

        function initChart(canvasId, data) {
            const ctx = document.getElementById(canvasId);
            if (!ctx) return null;
            const context = ctx.getContext('2d');
            if (revenueChart) revenueChart.destroy();
            return new Chart(context, {
                type: 'line',
                data: data,
                options: chartOptions
            });
        }

        function updateDashboard() {
            const months = monthlyData.map(item => item.month);
            const revenueValues = monthlyData.map(item => item.revenue);

            const revenueData = {
                labels: months,
                datasets: [{
                    label: 'Revenue',
                    data: revenueValues,
                    borderColor: '#7c3aed',
                    pointBackgroundColor: '#7c3aed',
                    backgroundColor: context => {
                        const chart = context.chart;
                        const { ctx, chartArea } = chart;
                        if (!chartArea) return;
                        return createGradient(ctx, chartArea, 'rgba(124, 58, 237, 0.05)', 'rgba(124, 58, 237, 0.2)', 'rgba(124, 58, 237, 0.5)');
                    },
                    fill: true,
                    tension: 0.4
                }]
            };

            revenueChart = initChart('revenueChart', revenueData);
        }

        updateDashboard();

        function fetchUpdatedData() {
            // Simulate dynamic fetching with the same data for demo
            // Replace this block with actual fetch if needed
            console.log('Fetching updated data...');
            setTimeout(() => {
                // simulate new data update
                monthlyData[Math.floor(Math.random() * 12)].revenue += Math.floor(Math.random() * 1000);
                totalRevenue = monthlyData.reduce((sum, m) => sum + m.revenue, 0);
                updateDashboard();
            }, 500);
        }

        function checkYearChange() {
            const currentYearNow = new Date().getFullYear();
            if (currentYearNow !== currentYear) {
                console.log('Year changed. Updating...');
                currentYear = currentYearNow;
                fetchUpdatedData();
            }
        }

        setInterval(checkYearChange, 300000); // 5 minutes
        setInterval(fetchUpdatedData, 30000); // 30 seconds
    });
</script>