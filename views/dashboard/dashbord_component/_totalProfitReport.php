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

  <div class="col-10 col-lg-4 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="m-0 me-2">Profit Report</h5>
      </div>
      <div class="card-body px-0">
        <canvas id="profitReportChart" class="chart-canvas"></canvas>
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

      // Sample data
      const monthlyData = [
        { month: 'Jan', profit: 1200 },
        { month: 'Feb', profit: 1500 },
        { month: 'Mar', profit: 1700 },
        { month: 'Apr', profit: 1400 },
        { month: 'May', profit: 1800 },
        { month: 'Jun', profit: 1600 },
        { month: 'Jul', profit: 1900 },
        { month: 'Aug', profit: 2000 },
        { month: 'Sep', profit: 2100 },
        { month: 'Oct', profit: 2200 },
        { month: 'Nov', profit: 2300 },
        { month: 'Dec', profit: 2400 },
      ];

      const months = monthlyData.map(item => item.month);
      const profitValues = monthlyData.map(item => item.profit);

      const ctx = document.getElementById('profitReportChart').getContext('2d');

      const profitReportChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: months,
          datasets: [{
            label: 'Profit',
            data: profitValues,
            borderColor: '#71dd37',
            pointBackgroundColor: '#71dd37',
            backgroundColor: function(context) {
              const chart = context.chart;
              const { ctx, chartArea } = chart;
              if (!chartArea) return null;
              const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
              gradient.addColorStop(0, 'rgba(113, 221, 55, 0.05)');
              gradient.addColorStop(0.5, 'rgba(113, 221, 55, 0.2)');
              gradient.addColorStop(1, 'rgba(113, 221, 55, 0.5)');
              return gradient;
            },
            fill: true,
            tension: 0.4,
          }]
        },
        options: chartOptions,
      });
    });
  </script>