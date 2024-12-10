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
                            SUM(oi.Quantity) AS totalOrderedQuantity
                        FROM 
                            product p
                        INNER JOIN 
                            order_items oi ON oi.ProductID = p.ProductID
                        INNER JOIN 
                            orders o ON oi.OrderID = o.OrderID
                        GROUP BY 
                            p.ProductName
                        ORDER BY 
                            totalOrderedQuantity DESC
                        LIMIT 3;
                        ";


            // Query for products never ordered
            $neverOrderedQuery = "SELECT 
                    p.ProductName,
                    0 AS totalOrderedQuantity
                FROM 
                    product p
                WHERE 
                    p.ProductID NOT IN (
                        SELECT DISTINCT ProductID 
                        FROM order_items
                    )
                ";


            // Query for least ordered products (ordered at least once)
            $leastOrderedQuery = "SELECT 
                    p.ProductName,
                    COALESCE(SUM(oi.Quantity), 0) AS totalOrderedQuantity
                FROM 
                    product p
                LEFT JOIN 
                    order_items oi ON oi.ProductID = p.ProductID
                LEFT JOIN 
                    orders o ON oi.OrderID = o.OrderID
                WHERE 
                    p.ProductID IN (
                        SELECT DISTINCT ProductID 
                        FROM order_items
                    )
                GROUP BY 
                    p.ProductName
                ORDER BY 
                    totalOrderedQuantity ASC
                LIMIT 3
                ";

            // // Combine the two queries using UNION
            // $botQuery = "($neverOrderedQuery) UNION ($leastOrderedQuery) ORDER BY totalOrderedQuantity ASC";

            // Get Top Performing Products
            $topResult = mysqli_query($conn, $topQuery);
            if ($topResult) {
                if (mysqli_num_rows($topResult) > 0) {
                    $topData = [];
                    while ($row = mysqli_fetch_assoc($topResult)) {
                        $topData[] = [
                            'productName' => $row['ProductName'],
                            'totalOrderedQuantity' => $row['totalOrderedQuantity']
                        ];
                    }
                    $topJSON = json_encode($topData);
                } else {
                    $topJSON = json_encode([]);
                }
            }

            // Get Never Ordered Products
            $neverOrderedResult = mysqli_query($conn, $neverOrderedQuery);
            if ($neverOrderedResult) {
                $neverOrderedData = [];
                while ($row = mysqli_fetch_assoc($neverOrderedResult)) {
                    $neverOrderedData[] = [
                        'productName' => $row['ProductName'],
                        'totalOrderedQuantity' => $row['totalOrderedQuantity']
                    ];
                }
                $neverOrderedJSON = json_encode($neverOrderedData);
            } else {
                $neverOrderedJSON = json_encode([]);
            }

            // Get Least Ordered Products
            $leastOrderedResult = mysqli_query($conn, $leastOrderedQuery);
            if ($leastOrderedResult) {
                $leastOrderedData = [];
                while ($row = mysqli_fetch_assoc($leastOrderedResult)) {
                    $leastOrderedData[] = [
                        'productName' => $row['ProductName'],
                        'totalOrderedQuantity' => $row['totalOrderedQuantity']
                    ];
                }
                $leastOrderedJSON = json_encode($leastOrderedData);
            } else {
                $leastOrderedJSON = json_encode([]);
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

            <!-- Least Ordered Products Chart -->
            <div class="card mt-5 justify-content-center">
                <div class="card-body">
                    <h4 class="card-title">Least Ordered Products</h4>
                    <div class="card-text">
                        <canvas id="leastOrderedChart" style="height: 15rem;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Never Ordered Products Chart -->
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Never Ordered Products</h4>
                    <div class="card-text">
                        <canvas id="neverOrderedChart" style="height: 15rem;"></canvas>
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
    const topQuantities = sortedTopData.map(item => item.totalOrderedQuantity);

    // Configure and render the Top Products chart
    const topConfig = {
        type: 'bar',
        data: {
            labels: topLabels,
            datasets: [{
                label: 'Order Frequency',
                data: topQuantities,
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
                    text: 'Top Performing Products'
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

    // Process Never Ordered Products Data
    const neverOrderedData = <?php echo $neverOrderedJSON; ?>;
    const neverOrderedLabels = neverOrderedData.map(item => item.productName);
    const neverOrderedQuantities = neverOrderedData.map(item => item.totalOrderedQuantity);

    const neverOrderedConfig = {
        type: 'bar',
        data: {
            labels: neverOrderedLabels,
            datasets: [{
                label: 'Order Frequency (Never Ordered)',
                data: neverOrderedQuantities,
                borderWidth: 1,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Never Ordered Products'
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

    const neverOrderedChart = new Chart(document.getElementById('neverOrderedChart'), neverOrderedConfig);

    // Process Least Ordered Products Data
    const leastOrderedData = <?php echo $leastOrderedJSON; ?>;
    const leastOrderedLabels = leastOrderedData.map(item => item.productName);
    const leastOrderedQuantities = leastOrderedData.map(item => item.totalOrderedQuantity);

    const leastOrderedConfig = {
        type: 'bar',
        data: {
            labels: leastOrderedLabels,
            datasets: [{
                label: 'Order Frequency (Least Ordered)',
                data: leastOrderedQuantities,
                borderWidth: 1,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Least Ordered Products'
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

    const leastOrderedChart = new Chart(document.getElementById('leastOrderedChart'), leastOrderedConfig);

    const topChart = new Chart(document.getElementById('topChart'), topConfig);
</script>

<?php include('includes/footer.php') ?>