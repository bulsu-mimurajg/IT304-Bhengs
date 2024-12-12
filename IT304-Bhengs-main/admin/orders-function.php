<?php

include('../config/function.php');
require_once('../config/Paymongo/vendor/autoload.php');

if (!isset($_SESSION['productItemIds'])) {
    $_SESSION['productItemIds'] = [];
}
if (!isset($_SESSION['productItems'])) {
    $_SESSION['productItems'] = [];
}

if (isset($_POST['addItem'])) {
    $productId = validate($_POST['productId']);
    $quantity = validate($_POST['quantity']);

    $checkProductExists = mysqli_query($conn, "SELECT * FROM product WHERE ProductID='$productId' LIMIT 1");
    if ($checkProductExists) {
        if (mysqli_num_rows($checkProductExists) > 0) {
            $row = mysqli_fetch_assoc($checkProductExists);
            if ($row['Quantity'] < $quantity) {
                redirect('orders-create.php', 'Insufficient Product Quantity. CURRENT STOCK: ' . $row['Quantity']);
            }
            $productData = [
                'ProductID' => $row['ProductID'],
                'ProductName' => $row['ProductName'],
                'Price' => $row['Price'],
                'Quantity' => $quantity,
                'ProductImage' => $row['ProductImage'],
            ];

            if (!in_array($row['ProductID'], $_SESSION['productItemIds'])) {
                array_push($_SESSION['productItemIds'], $row['ProductID']);
                array_push($_SESSION['productItems'], $productData);
            } else {
                foreach ($_SESSION['productItems'] as $key => $sessionProductItem) {
                    if ($sessionProductItem['ProductID'] == $row['ProductID']) {
                        $newQuantity = $sessionProductItem['Quantity'] + $quantity;

                        $productData = [
                            'ProductID' => $row['ProductID'],
                            'ProductName' => $row['ProductName'],
                            'Price' => $row['Price'],
                            'Quantity' => $newQuantity,
                            'ProductImage' => $row['ProductImage'],
                        ];
                        $_SESSION['productItems'][$key] = $productData;
                    }
                }
            }
            redirect('orders-create.php', 'Item [' . $row['ProductName'] . '] added');
        } else {
            redirect('orders-create.php', 'Product does not exist.');
        }
    } else {
        redirect('orders-create.php', 'Something went wrong.');
    }
}

if (isset($_POST['productIncDec'])) {
    $productId = validate($_POST['ProductID']);
    $quantity = validate($_POST['Quantity']);
    $flag = false;

    foreach ($_SESSION['productItems'] as $key => $item) {
        if ($item['ProductID'] == $productId) {
            $flag = true;
            $_SESSION['productItems'][$key]['Quantity'] = $quantity;
        }
    }

    if ($flag) {
        jResponse(200, 'success', 'Quantity updated');
    } else {
        jResponse(500, 'error', 'Something went wrong');
    }
}

if (isset($_POST['placeOrder'])) {
    $phone = validate($_POST['phone']);
    $paymentMode = validate($_POST['paymentMode']);

    //Check if customer exists
    $checkCustomer = mysqli_query($conn, "SELECT * FROM customer WHERE Phone='$phone' LIMIT 1");
    if ($checkCustomer) {
        if (mysqli_num_rows($checkCustomer) > 0) {
            $_SESSION['invoice_no'] = "INV-" . rand(111111, 999999);
            $_SESSION['phone'] = $phone;
            $_SESSION['payment_mode'] = $paymentMode;
            jResponse(200, 'success', 'Customer exists');
        } else {
            $_SESSION['phone'] = $phone;
            jResponse(404, 'invalid', 'Customer does not exist');
        }
    } else {
        jResponse(500, 'error', 'Something went wrong');
    }
}


if (isset($_POST['saveOrder'])) {
    $phone = validate($_SESSION['phone']);
    $paymentMode = validate($_SESSION['payment_mode']);
    $invoiceNo = validate($_SESSION['invoice_no']);

    //Check if customer exists
    $checkCustomer = mysqli_query($conn, "SELECT * FROM customer WHERE Phone='$phone' LIMIT 1");
    if ($checkCustomer) {
        if (mysqli_num_rows($checkCustomer) > 0) {
            $customerData = mysqli_fetch_assoc($checkCustomer);

            if (isset($_SESSION['productItems'])) {
                $sessionProducts = $_SESSION['productItems'];
                $totalPrice = 0;
                foreach ($sessionProducts as $item) {
                    $totalPrice += $item['Price'] * $item['Quantity'];
                }

                // Paymongo API
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
                    'body' => '{"data":{"attributes":{"amount":' . ($totalPrice * 100) . ',"description":"my payment"}}}',
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Basic c2tfdGVzdF8yR01aZG9LYjg2dDVoV2lQOW01czNlN246',
                        'content-type' => 'application/json',
                    ],
                ]);

                $paymentData = json_decode($response->getBody(), true);
                $checkoutUrl = $paymentData['data']['attributes']['checkout_url'];

                $data = [
                    'CustomerID' => $customerData['CustomerID'],
                    'TrackingNo' => $paymentData['data']['attributes']['reference_number'],
                    'InvoiceNo' => $invoiceNo,
                    'TotalPrice' => $totalPrice,
                    'OrderDate' => date('Y-m-d'),
                    'OrderStatus' => 'Pending',
                    'PaymentMode' => $paymentMode,
                    'CheckoutURL' => $checkoutUrl,
                ];
                $result = insert('orders', $data);
                $lastOrderId = mysqli_insert_id($conn);

                foreach ($sessionProducts as $item) {
                    $productId = $item['ProductID'];
                    $price = $item['Price'];
                    $quantity = $item['Quantity'];

                    $dataOrderItem = [
                        'OrderID' => $lastOrderId,
                        'ProductID' => $productId,
                        'Price' => $price,
                        'Quantity' => $quantity,
                    ];
                    $query = insert('order_items', $dataOrderItem);

                    $checkQuantity = mysqli_query($conn, "SELECT * FROM product WHERE ProductID='$productId'");
                    $productQuantity = mysqli_fetch_assoc($checkQuantity);
                    $newProductQuantity = $productQuantity['Quantity'] - $quantity;

                    if ($newProductQuantity < 0) {
                        jResponse(400, 'invalid', "Not enough stock for product ID: $productId");
                        return;
                    }

                    // Update the quantity in the database
                    $updateQuantityQuery = "UPDATE product SET Quantity = '$newProductQuantity' WHERE ProductID = '$productId'";
                    $updateQuantity = mysqli_query($conn, $updateQuantityQuery);

                    if (!$updateQuantity) {
                        jResponse(500, 'error', 'Failed to update product quantity');
                        return;
                    }

                    $qtyUpdate = [
                        'Quantity' => $newProductQuantity
                    ];

                    $updateQuantity = update('product', 'Quantity', $productId, $qtyUpdate);
                }
                unset($_SESSION['productItemIds']);
                unset($_SESSION['productItems']);
                unset($_SESSION['phone']);
                unset($_SESSION['invoice_no']);

                jResponse(200, 'success', 'Order successfully created');
            }
        } else {
            jResponse(404, 'invalid', 'Customer does not exist');
        }
    } else {
        jResponse(500, 'error', 'Something went wrong');
    }
}
