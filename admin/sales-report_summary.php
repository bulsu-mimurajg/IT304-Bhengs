<?php include('includes/header.php'); ?>

<!-- SHOWS ERROR IF NOT CALLED BEFORE DIV -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid px-4">
    <div class="row justify-content-center m-5">
        <div class="col-md-12 mb-5">
            <?php
            $categoryQuery = "SELECT 
                            pc.CategoryID,
                            pc.CategoryName,
                            SUM(oi.Price * oi.Quantity) AS TotalSales
                        FROM 
                            product_category pc
                        INNER JOIN 
                            product p ON pc.CategoryID = p.CategoryID
                        INNER JOIN 
                            order_items oi ON p.ProductID = oi.ProductID
                        GROUP BY 
                            pc.CategoryID, pc.CategoryName
                        ORDER BY 
                            TotalSales DESC";

            $productQuery = "SELECT 
                            p.ProductID,
                            p.ProductName,
                            SUM(oi.Price * oi.Quantity) AS TotalSales
                        FROM 
                            product p
                        INNER JOIN 
                            order_items oi ON p.ProductID = oi.ProductID
                        GROUP BY 
                            p.ProductID, p.ProductName
                        ORDER BY 
                            TotalSales DESC";

            $categoryResult = mysqli_query($conn, $categoryQuery);
            if ($categoryResult) {
                if (mysqli_num_rows($categoryResult) > 0) {
                    $salesData = [];
                    $totalSales = 0;
                    while ($row = mysqli_fetch_assoc($categoryResult)) {
                        $salesData[] = [
                            'category' => $row['CategoryName'],
                            'sales' => $row['TotalSales']
                        ];
                        $totalSales += $row['TotalSales'];
                    }
                    $jFormat = json_encode($salesData);
                } else {
                    $jFormat = json_encode([]);
                }
            } else {
                $jFormat = json_encode([]);
            }

            $productResult = mysqli_query($conn, $productQuery);
            if ($productResult) {
                if (mysqli_num_rows($productResult) > 0) {
                    $productSalesData = [];
                    while ($row = mysqli_fetch_assoc($productResult)) {
                        $productSalesData[] = [
                            'product' => $row['ProductName'],
                            'sales' => $row['TotalSales']
                        ];
                    }

                    $productSalesJSON = json_encode($productSalesData);
                } else {
                    $productSalesJSON = json_encode([]);
                }
            } else {
                $productSalesJSON = json_encode([]);
            }
            ?>
            <div class="card bg-info">
                <div class="card-body">
                    <h4 class="card-title">Total Sales</h4>
                    <div class="card-text">PHP <?= number_format($totalSales) ?> </div>
                </div>
            </div>

        </div>
        <div class="col-md-9 justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sales by Category</h4>
                    <div class="card-text">
                        <canvas id="myCategory" style="height: 15rem;"></canvas>
                    </div>
                </div>
            </div>

            <div class="card mt-5 justify-content-center">
                <div class="card-body">
                    <h4 class="card-title">Sales by Product</h4>
                    <div class="card-text">
                        <canvas id="myProduct" style="height: 15rem;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Pass PHP data to JavaScript
    const salesData = <?php echo $jFormat; ?>; // Example: [{category: 'Electronics', sales: 1200}, {category: 'Furniture', sales: 800}]

    const sortedCategorySalesData = salesData.sort((a, b) => a.sales - b.sales);

    // Extract labels and data from salesData
    const labels = salesData.map(item => item.category); // Categories
    const salesValues = salesData.map(item => item.sales); // Total Sales per category

    // Configure and render the chart
    const data = {
        labels: labels, // Use categories as labels
        datasets: [{
            label: 'Revenue',
            data: salesValues, // Sales data
            borderWidth: 1,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Sales (₱)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Category'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            responsive: true,
            maintainAspectRatio: false // Ensures chart fills the container
        }
    };

    const mySummary = new Chart(
        document.getElementById('myCategory'),
        config
    );

    // Pass PHP data to JavaScript
    const productSalesData = <?php echo $productSalesJSON; ?>;

    const sortedProductSalesData = productSalesData.sort((a, b) => a.sales - b.sales);

    // Extract labels and data
    const productLabels = productSalesData.map(item => item.product);
    const productSales = productSalesData.map(item => item.sales);

    // Configure and render the chart
    const productData = {
        labels: productLabels, // Use product names as labels
        datasets: [{
            label: 'Total Sales by Product',
            data: productSales, // Total sales for each product
            borderWidth: 1,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
        }]
    };

    const productConfig = {
        type: 'bar',
        data: productData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ''
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
            },
            responsive: true,
            maintainAspectRatio: false
        }
    };

    const productChart = new Chart(
        document.getElementById('myProduct'),
        productConfig
    );
</script>


<?php include('includes/footer.php'); ?>