<?php
include('../config/dbcon.php');

header('Content-Type: application/json');

if (isset($_GET['period'])) {
    $period = $_GET['period'];

    // Determine the date range
    switch ($period) {
        case 'week':
            $dateCondition = "DATE(OrderDate) >= CURDATE() - INTERVAL 7 DAY AND DATE(OrderDate) <= CURDATE()";
            break;
        case 'month':
            $dateCondition = "DATE_FORMAT(OrderDate, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')";
            break;
        case 'year':
            $dateCondition = "YEAR(OrderDate) = YEAR(CURDATE())";
            break;
        default:
            $dateCondition = "1=1"; // Fetch all data
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
}
