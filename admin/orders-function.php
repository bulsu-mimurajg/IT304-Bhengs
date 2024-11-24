<?php

include('../config/function.php');

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

if (isset($_POST['placeOrderBtn'])) {
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
