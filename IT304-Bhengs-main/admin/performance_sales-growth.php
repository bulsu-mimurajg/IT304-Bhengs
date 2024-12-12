<?php include('includes/header.php') ?>

<!-- SHOWS ERROR IF NOT CALLED BEFORE DIV -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid px-4">
    <div class="row m-5 justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <label for="salesPeriod">Select Period:</label>
                    <div id="salesPeriodContainer">
                        <select id="salesPeriod" class="form-select" onchange="handlePeriodChange()">
                            <option value="week">Last 7 Days</option>
                            <option value="last_month">Last Month</option>
                            <option value="month">This Month</option>
                            <option value="half_year">Last 6 Months</option>
                            <option value="last_year">Last Year</option>
                            <option value="year">This Year</option>
                            <option value="all_time">All Time</option>
                            <option value="custom">Custom Range</option>
                        </select>

                        <div id="customRangeInputs" style="display: none; margin-top: 10px;">
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate" class="form-control">

                            <label for="endDate" style="margin-top: 10px;">End Date:</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                    </div>

                    <button id="fetchData" class="btn btn-primary mt-3">Show</button>
                </div>
            </div>
            <div class="card mt-5 justify-content-center">
                <div class="card-body">
                    <h4 class="card-title">Sales Growth by Period</h4>
                    <div class="card-text">
                        <canvas id="salesGrowthChart"></canvas>
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
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `₱ ${context.raw.toLocaleString()}`;
                            }
                        }
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
        let url = 'performance_sales-growth-json.php?period=' + period;

        // Include custom range parameters if selected
        if (period === 'custom') {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (!startDate || !endDate) {
                alert('Please select both start and end dates for the custom range.');
                return;
            }

            url += `&startDate=${startDate}&endDate=${endDate}`;
        }

        try {
            const response = await fetch(url);
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

    function handlePeriodChange() {
        const period = document.getElementById("salesPeriod").value;
        const customRangeInputs = document.getElementById("customRangeInputs");

        if (period === "custom") {
            customRangeInputs.style.display = "block";
        } else {
            customRangeInputs.style.display = "none";
        }
    }

    // Event listener for button click
    document.getElementById('fetchData').addEventListener('click', fetchData);

    // Initial fetch for default period
    fetchData();
</script>


<?php include('includes/footer.php') ?>