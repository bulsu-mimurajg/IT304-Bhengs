<?php

include('../config/function.php');

// if (!isset($_SESSION['productItems'])) {
//     $_SESSION['productItems'] = [];
// }

// $cartData = json_decode(file_get_contents('php://input'), true);

// if (!$cartData || empty($cartData)) {
//     echo json_encode(['status' => 404, 'message' => 'Cart is empty.']);
//     exit;
// }

// $_SESSION['productItems'] = $cartData;

try {
    // Decode JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if input is empty
    if (empty($input)) {
        echo json_encode(['status' => 400, 'message' => 'Empty cart data.']);
        exit;
    }

    // Handle cart data sent from "placeOrder"
    if (!empty($input['cart'])) {
        $_SESSION['cart'] = $input['cart'];
        $_SESSION['invoice_no'] = "INV-" . rand(111111, 999999);
        $_SESSION['payment_mode'] = 'GCash'; // Example payment mode

        // Success response for "placeOrder"
        echo json_encode(['status' => 200, 'message' => 'Cart data saved successfully.']);
        exit;
    }

    // Handle order saving from "saveOrder"
    if (!empty($input['saveOrder'])) {
        if (empty($_SESSION['cart'])) {
            echo json_encode(['status' => 400, 'message' => 'Cart is empty.']);
            exit;
        }

        $sessionProducts = $_SESSION['cart'];
        $totalPrice = 0;

        // Calculate total price
        foreach ($sessionProducts as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Insert order data
        $data = [
            'CustomerID' => $_SESSION['loggedInUser']['CustomerID'],
            'TrackingNo' => rand(11111, 99999),
            'InvoiceNo' => $_SESSION['invoice_no'],
            'TotalPrice' => $totalPrice,
            'OrderDate' => date('Y-m-d'),
            'OrderStatus' => 'Pending',
            'PaymentMode' => $_SESSION['payment_mode']
        ];
        $result = insert('orders', $data);
        $lastOrderId = mysqli_insert_id($conn);

        // Insert order items
        foreach ($sessionProducts as $item) {
            $productId = $item['id'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            $dataOrderItem = [
                'OrderID' => $lastOrderId,
                'ProductID' => $productId,
                'Price' => $price,
                'Quantity' => $quantity,
            ];
            insert('order_items', $dataOrderItem);

            // Update product stock
            $checkQuantity = mysqli_query($conn, "SELECT * FROM product WHERE ProductID='$productId'");
            $productQuantity = mysqli_fetch_assoc($checkQuantity);
            $newProductQuantity = $productQuantity['Quantity'] - $quantity;

            if ($newProductQuantity < 0) {
                echo json_encode(['status' => 400, 'message' => "Not enough stock for product ID: $productId"]);
                exit;
            }

            $updateQuantityQuery = "UPDATE product SET Quantity = '$newProductQuantity' WHERE ProductID = '$productId'";
            mysqli_query($conn, $updateQuantityQuery);
        }

        // Clear session data
        unset($_SESSION['cart'], $_SESSION['invoice_no'], $_SESSION['payment_mode']);

        echo json_encode(['status' => 200, 'message' => 'Order successfully created']);
        exit;
    }

    // Invalid request handling
    echo json_encode(['status' => 400, 'message' => 'Invalid request.']);
} catch (Exception $e) {
    echo json_encode(['status' => 500, 'message' => 'Internal Server Error.']);
}
