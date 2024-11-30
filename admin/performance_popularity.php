<?php include('includes/header.php') ?>

<!-- SHOWS ERROR IF NOT CALLED BEFORE DIV -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid px-4">
    <div class="row justify-content-center m-5">
        <div class="col-md-9 justify-content-center">
            <?php
            // Top 3 Most Ordered Products Query
            $topQuery = "SELECT 
                            p.ProductName,
                            COUNT(DISTINCT o.OrderID) AS orderFrequency
                        FROM 
                            product p
                        INNER JOIN 
                            order_items oi ON oi.ProductID = p.ProductID
                        INNER JOIN 
                            orders o ON oi.OrderID = o.OrderID
                        GROUP BY 
                            p.ProductName
                        ORDER BY 
                            orderFrequency DESC
                        LIMIT 3;";


            // Top 3 Least Ordered Products Query
            $botQuery = "SELECT 
                            p.ProductName,
                            COUNT(DISTINCT o.OrderID) AS orderFrequency
                        FROM 
                            product p
                        LEFT JOIN 
                            order_items oi ON oi.ProductID = p.ProductID
                        LEFT JOIN 
                            orders o ON oi.OrderID = o.OrderID
                        GROUP BY 
                            p.ProductName
                        ORDER BY 
                            orderFrequency ASC
                        LIMIT 3;";


            // Get Top Performing Products
            $topResult = mysqli_query($conn, $topQuery);
            if ($topResult) {
                if (mysqli_num_rows($topResult) > 0) {
                    $topData = [];
                    while ($row = mysqli_fetch_assoc($topResult)) {
                        $topData[] = [
                            'productName' => $row['ProductName'],
                            'orderFrequency' => $row['orderFrequency']
                        ];
                    }
                    $topJSON = json_encode($topData);
                } else {
                    $topJSON = json_encode([]);
                }
            }

            // Get Bottom Performing Products (last 7 days)
            $botResult = mysqli_query($conn, $botQuery);
            if ($botResult) {
                if (mysqli_num_rows($botResult) > 0) {
                    $botData = [];
                    while ($row = mysqli_fetch_assoc($botResult)) {
                        $botData[] = [
                            'productName' => $row['ProductName'],
                            'orderFrequency' => $row['orderFrequency']
                        ];
                    }
                    $botJSON = json_encode($botData);
                } else {
                    $botJSON = json_encode([]);
                }
            }
            ?>

            <!-- Top 3 Most Ordered -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Top 3 Most Ordered</h4>
                    <div class="card-text">
                        <canvas id="topChart" style="height: 15rem;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top 3 Least Ordered -->
            <div class="card mt-5 justify-content-center">
                <div class="card-body">
                    <h4 class="card-title">Top 3 Least Ordered</h4>
                    <div class="card-text">
                        <canvas id="botChart" style="height: 15rem;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const topData = <?php echo $topJSON; ?>;

    // Sort Top Data by Order Frequency Descending
    const sortedTopData = topData.sort((a, b) => b.orderFrequency - a.orderFrequency);

    // Extract labels and data
    const topLabels = sortedTopData.map(item => item.productName);
    const topFrequencies = sortedTopData.map(item => item.orderFrequency);

    // Configure and render the Top Products chart
    const topConfig = {
        type: 'bar',
        data: {
            labels: topLabels,
            datasets: [{
                label: 'Order Frequency',
                data: topFrequencies,
                borderWidth: 1,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Top Ordered Products (Frequency)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Order Frequency'
                    }
                }
            }
        }
    };

    const topChart = new Chart(document.getElementById('topChart'), topConfig);


    const botData = <?php echo $botJSON; ?>;

    // Sort Bottom Data by Order Frequency Ascending
    const sortedBotData = botData.sort((a, b) => a.orderFrequency - b.orderFrequency);

    // Extract labels and data
    const botLabels = sortedBotData.map(item => item.productName);
    const botFrequencies = sortedBotData.map(item => item.orderFrequency);

    // Configure and render the Least Ordered Products chart
    const botConfig = {
        type: 'bar',
        data: {
            labels: botLabels,
            datasets: [{
                label: 'Order Frequency',
                data: botFrequencies,
                borderWidth: 1,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Least Ordered Products (Frequency)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Order Frequency'
                    }
                }
            }
        }
    };

    const botChart = new Chart(document.getElementById('botChart'), botConfig);
</script>

<?php include('includes/footer.php') ?>