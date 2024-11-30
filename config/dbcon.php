<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'sales_report');

// Connect to MySQL server
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (!$conn) {
    die("Connection to MySQL server failed! " . mysqli_connect_error());
}

// Check if the database exists, and create it if not
$db_check_query = "SHOW DATABASES LIKE '" . DB_DATABASE . "'";
$db_check_result = mysqli_query($conn, $db_check_query);

if (mysqli_num_rows($db_check_result) == 0) {
    $create_db_query = "CREATE DATABASE " . DB_DATABASE;
    if (mysqli_query($conn, $create_db_query)) {
        echo "Database '" . DB_DATABASE . "' created successfully.\n";
    } else {
        die("Error creating database: " . mysqli_error($conn));
    }
}

// Select the database
mysqli_select_db($conn, DB_DATABASE);

// Tables to create
$tables = [
    "customer" => "
        CREATE TABLE `customer` (
            `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
            `FName` varchar(255) NOT NULL,
            `LName` varchar(255) NOT NULL,
            `Address` varchar(255) NOT NULL,
            `Email` varchar(255) NOT NULL,
            `Phone` varchar(255) NOT NULL,
            `Password` varchar(255) NOT NULL,
            PRIMARY KEY (`CustomerID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",
    "orders" => "
        CREATE TABLE `orders` (
            `OrderID` int(11) NOT NULL AUTO_INCREMENT,
            `CustomerID` int(11) NOT NULL,
            `TrackingNo` varchar(100) NOT NULL,
            `InvoiceNo` varchar(100) NOT NULL,
            `TotalPrice` varchar(100) NOT NULL,
            `OrderDate` date NOT NULL,
            `OrderStatus` varchar(100) NOT NULL,
            `PaymentMode` varchar(100) NOT NULL,
            PRIMARY KEY (`OrderID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",
    "order_items" => "
        CREATE TABLE `order_items` (
            `ID` int(11) NOT NULL AUTO_INCREMENT,
            `OrderID` int(11) NOT NULL,
            `ProductID` int(11) NOT NULL,
            `Price` varchar(100) NOT NULL,
            `Quantity` varchar(100) NOT NULL,
            PRIMARY KEY (`ID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",
    "product" => "
        CREATE TABLE `product` (
            `ProductID` int(11) NOT NULL AUTO_INCREMENT,
            `ProductName` varchar(255) NOT NULL,
            `Price` int(11) NOT NULL,
            `Quantity` int(11) NOT NULL,
            `ProductImage` varchar(255) NOT NULL,
            `CategoryID` int(11) NOT NULL,
            PRIMARY KEY (`ProductID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",
    "product_category" => "
        CREATE TABLE `product_category` (
            `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
            `CategoryName` varchar(255) NOT NULL,
            `CategoryDescription` varchar(1000) DEFAULT NULL,
            PRIMARY KEY (`CategoryID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    "
];

// Create tables if they don't exist
foreach ($tables as $table_name => $create_query) {
    $table_check_query = "SHOW TABLES LIKE '$table_name'";
    $table_check_result = mysqli_query($conn, $table_check_query);

    if (mysqli_num_rows($table_check_result) == 0) {
        if (mysqli_query($conn, $create_query)) {
            echo "Table '$table_name' created successfully.\n";
        } else {
            die("Error creating table '$table_name': " . mysqli_error($conn));
        }
    }
}
