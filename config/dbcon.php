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
    "product_category" => "
        CREATE TABLE `product_category` (
            `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
            `CategoryName` varchar(255) NOT NULL,
            `CategoryDescription` varchar(1000) DEFAULT NULL,
            PRIMARY KEY (`CategoryID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",
    "customer" => "
        CREATE TABLE `customer` (
            `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
            `FName` varchar(255) NOT NULL,
            `LName` varchar(255) NOT NULL,
            `Address` varchar(255) NOT NULL,
            `Email` varchar(255) NOT NULL UNIQUE,
            `Phone` varchar(255) NOT NULL,
            `Password` varchar(255) NOT NULL,
            PRIMARY KEY (`CustomerID`)
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

$alterQueries = [
    [
        "table" => "product",
        "constraint" => "fk_product_category",
        "query" => "ALTER TABLE `product` ADD CONSTRAINT `fk_product_category`
                    FOREIGN KEY (`CategoryID`) REFERENCES `product_category`(`CategoryID`)
                    ON DELETE CASCADE ON UPDATE CASCADE;"
    ],
    [
        "table" => "orders",
        "constraint" => "fk_orders_customer",
        "query" => "ALTER TABLE `orders` ADD CONSTRAINT `fk_orders_customer`
                    FOREIGN KEY (`CustomerID`) REFERENCES `customer`(`CustomerID`)
                    ON DELETE CASCADE ON UPDATE CASCADE;"
    ],
    [
        "table" => "order_items",
        "constraint" => "fk_order_items_order",
        "query" => "ALTER TABLE `order_items` ADD CONSTRAINT `fk_order_items_order`
                    FOREIGN KEY (`OrderID`) REFERENCES `orders`(`OrderID`)
                    ON DELETE CASCADE ON UPDATE CASCADE;"
    ],
    [
        "table" => "order_items",
        "constraint" => "fk_order_items_product",
        "query" => "ALTER TABLE `order_items` ADD CONSTRAINT `fk_order_items_product`
                    FOREIGN KEY (`ProductID`) REFERENCES `product`(`ProductID`)
                    ON DELETE CASCADE ON UPDATE CASCADE;"
    ]
];

// Check and execute ALTER TABLE queries
foreach ($alterQueries as $alter) {
    $checkQuery = "
        SELECT CONSTRAINT_NAME
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE TABLE_NAME = '{$alter['table']}'
        AND CONSTRAINT_NAME = '{$alter['constraint']}'
        AND CONSTRAINT_SCHEMA = DATABASE();
    ";

    $checkResult = mysqli_query($conn, $checkQuery);

    // Only run ALTER TABLE if the foreign key does not already exist
    if (mysqli_num_rows($checkResult) == 0) {
        if (mysqli_query($conn, $alter['query'])) {
            echo "Foreign key constraint '{$alter['constraint']}' added successfully to '{$alter['table']}'.\n";
        } else {
            die("Error adding foreign key constraint: " . mysqli_error($conn));
        }
    }
}



// Insert default data
$default_data = [
    "customer" => [
        ["FName" => 'Jaden', "LName" => "Mimura", "Address" => "123 Main St, Cityville", "Email" => "vioaescode@gmail.com", "Phone" => "123-456-7890", "Password" => password_hash('asd', PASSWORD_DEFAULT)],
    ],
    "product_category" => [
        ["CategoryName" => "Kimchi Family", "CategoryDescription" => "Kimchi 4 Life"],
        ["CategoryName" => "Kimbap Family", "CategoryDescription" => "Kimbap Bops"],
        ["CategoryName" => "Homemade Specials", "CategoryDescription" => "Freshly Made"],
        ["CategoryName" => "Filipino", "CategoryDescription" => "Filipino Classics"],
    ],
    "product" => [
        ["ProductName" => "Radish Kimchi", "Price" => 80, "Quantity" => 100, "ProductImage" => "assets/img/radishkimchi.jpg", "CategoryID" => 1],
        ["ProductName" => "Napa Kimchi", "Price" => 80, "Quantity" => 100, "ProductImage" => "assets/img/napa.jpg", "CategoryID" => 1],
        ["ProductName" => "Kimchi Sauce", "Price" => 80, "Quantity" => 100, "ProductImage" => "assets/img/sauce.jpg", "CategoryID" => 1],
        ["ProductName" => "Kimchi Rice", "Price" => 40, "Quantity" => 100, "ProductImage" => "assets/img/rice.jpg", "CategoryID" => 1],
        ["ProductName" => "Kimchi Ramen", "Price" => 150, "Quantity" => 100, "ProductImage" => "assets/img/ramen.jpg", "CategoryID" => 1],
        ["ProductName" => "Regular Kimbap", "Price" => 140, "Quantity" => 100, "ProductImage" => "assets/img/kimbap.jpg", "CategoryID" => 2],
        ["ProductName" => "Kimchi Kimbap", "Price" => 140, "Quantity" => 100, "ProductImage" => "assets/img/kimchibap.jpg", "CategoryID" => 2],
        ["ProductName" => "Pork", "Price" => 220, "Quantity" => 100, "ProductImage" => "assets/img/pork.png", "CategoryID" => 3],
        ["ProductName" => "Beef", "Price" => 235, "Quantity" => 100, "ProductImage" => "assets/img/beef.jpg", "CategoryID" => 3],
        ["ProductName" => "Palabok", "Price" => 280, "Quantity" => 100, "ProductImage" => "assets/img/palabok.jpg", "CategoryID" => 4],
        ["ProductName" => "Pansit", "Price" => 280, "Quantity" => 100, "ProductImage" => "assets/img/pansit.jpg", "CategoryID" => 4],
        ["ProductName" => "Malabon", "Price" => 280, "Quantity" => 100, "ProductImage" => "assets/img/malabon.jpg", "CategoryID" => 4],
        ["ProductName" => "Maja", "Price" => 280, "Quantity" => 100, "ProductImage" => "assets/img/maja.jpg", "CategoryID" => 4],
        ["ProductName" => "Sapin-sapin", "Price" => 280, "Quantity" => 100, "ProductImage" => "assets/img/sapin.jpg", "CategoryID" => 4],
        ["ProductName" => "Pichi-pichi", "Price" => 280, "Quantity" => 100, "ProductImage" => "assets/img/pichi.jpg", "CategoryID" => 4],
        ["ProductName" => "Palitaw", "Price" => 280, "Quantity" => 100, "ProductImage" => "assets/img/palitaw.jpg", "CategoryID" => 4]
    ]
];

foreach ($default_data as $table_name => $rows) {
    foreach ($rows as $row) {
        // Prepare the INSERT query dynamically
        $columns = implode(", ", array_keys($row));
        $values = implode("', '", array_map(function ($value) use ($conn) {
            return mysqli_real_escape_string($conn, $value);
        }, array_values($row)));

        // Define a unique key for each table
        $unique_keys = [
            "customer" => "Email",
            "product_category" => "CategoryName",
            "product" => "ProductName"
        ];

        if (isset($unique_keys[$table_name])) {
            $unique_key = $unique_keys[$table_name];
            $unique_value = mysqli_real_escape_string($conn, $row[$unique_key]);

            // Check if the record exists based on the unique key
            $check_query = "SELECT * FROM `$table_name` WHERE `$unique_key` = '$unique_value'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) == 0) {
                // Insert the data if it doesn't already exist
                $insert_query = "INSERT INTO `$table_name` ($columns) VALUES ('$values')";
                mysqli_query($conn, $insert_query);
            }
        } else {
            // If no unique key is defined for the table, insert without checking
            $insert_query = "INSERT INTO `$table_name` ($columns) VALUES ('$values')";
            mysqli_query($conn, $insert_query);
        }
    }
}
