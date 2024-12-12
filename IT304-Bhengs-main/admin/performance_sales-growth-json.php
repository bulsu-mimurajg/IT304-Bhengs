<?php
include('../config/dbcon.php');

header('Content-Type: application/json');

if (isset($_GET['period'])) {
    $period = $_GET['period'];

    // Initialize dateCondition
    $dateCondition = "1=1";

    // Handle custom date range
    if ($period === 'custom' && isset($_GET['startDate']) && isset($_GET['endDate'])) {
        $startDate = mysqli_real_escape_string($conn, $_GET['startDate']);
        $endDate = mysqli_real_escape_string($conn, $_GET['endDate']);
        $dateCondition = "DATE(OrderDate) BETWEEN '$startDate' AND '$endDate'";
    } else {
        // Determine the date range for predefined periods
        switch ($period) {
            case 'week':
                $dateCondition = "DATE(OrderDate) >= CURDATE() - INTERVAL 7 DAY AND DATE(OrderDate) <= CURDATE()";
                break;
            case 'month':
                $dateCondition = "DATE_FORMAT(OrderDate, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')";
                break;
            case 'last_month':
                $dateCondition = "DATE_FORMAT(OrderDate, '%Y-%m') = DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m')";
                break;
            case 'half_year':
                $dateCondition = "DATE(OrderDate) >= CURDATE() - INTERVAL 6 MONTH";
                break;
            case 'year':
                $dateCondition = "YEAR(OrderDate) = YEAR(CURDATE())";
                break;
            case 'last_year':
                $dateCondition = "YEAR(OrderDate) = YEAR(CURDATE()) - 1";
                break;
            case 'all_time':
                $dateCondition = "1=1";
                break;
        }
    }

    // Query sales data
    $query = "SELECT 
                DATE_FORMAT(OrderDate, '%Y-%m-%d') AS date, 
                SUM(oi.Price * oi.Quantity) AS totalSales
              FROM 
                orders o
              INNER JOIN 
                order_items oi ON o.OrderID = oi.OrderID
              WHERE $dateCondition
              GROUP BY date
              ORDER BY date ASC";

    $result = mysqli_query($conn, $query);

    $salesData = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $salesData[] = [
                'date' => $row['date'],
                'sales' => $row['totalSales']
            ];
        }
    }

    echo json_encode($salesData);
} else {
    echo json_encode(['error' => 'Period parameter is missing.']);
}
