<?php include('includes/header.php') ?>

<!-- SHOWS ERROR IF NOT CALLED BEFORE DIV -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid px-4">
    <div class="row m-5 justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <label for="salesPeriod">Select Period:</label>
                    <select id="salesPeriod" class="form-select">
                        <option value="week">Last 7 Days</option>
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                    <button id="fetchData" class="btn btn-primary mt-3">Show</button>
                </div>
            </div>
            <div class="card mt-5 justify-content-center">
                <div class="card-body">
                    <h4 class="card-title">Sales Growth by Period</h4>
                    <div class="card-text">
                        <canvas id="salesGrowthChart" style="height: 5rem;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let myChart;

    // Function to update chart
    function updateChart(data) {
        const labels = data.map(item => item.date);
        const sales = data.map(item => item.sales);

        const chartData = {
            labels: labels,
            datasets: [{
                label: 'Sales Growth',
                data: sales,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Sales Growth'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Sales (₱)'
                        }
                    }
                }
            }
        };

        // Destroy previous chart instance if it exists
        if (myChart) {
            myChart.destroy();
        }

        // Create a new chart
        const ctx = document.getElementById('salesGrowthChart').getContext('2d');
        myChart = new Chart(ctx, config);
    }

    // Function to fetch data
    async function fetchData() {
        const period = document.getElementById('salesPeriod').value;

        try {
            const response = await fetch('performance_sales-growth-json.php?period=' + period);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            if (data.error) {
                console.error('Error from server:', data.error);
                return;
            }

            // Update chart with fetched data
            updateChart(data);
        } catch (error) {
            console.error('Error fetching sales data:', error);
        }
    }

    // Event listener for button click
    document.getElementById('fetchData').addEventListener('click', fetchData);

    // Initial fetch for default period
    fetchData();
</script>


<?php include('includes/footer.php') ?>