<?php

require '../config/function.php';

if (isset($_GET['id'])) {
    if ($_GET['id']) {
        $id = validate($_GET['id']);

        if (is_numeric($id)) {
            $order = getById('orders', 'TrackingNo', $id);
            if ($order['status'] == 200) {
                // Get all items related to this order
                $orderId = $order['data']['OrderID']; // Assuming the `getById` function fetches `OrderID`.
                $orderItemsQuery = "SELECT ProductID, Quantity FROM order_items WHERE OrderID = $orderId";
                $orderItems = mysqli_query($conn, $orderItemsQuery);

                if (mysqli_num_rows($orderItems) > 0) {
                    while ($item = mysqli_fetch_assoc($orderItems)) {
                        $productId = $item['ProductID'];
                        $quantity = $item['Quantity'];

                        // Update the product stock
                        $updateStockQuery = "UPDATE product SET Quantity = Quantity + $quantity WHERE ProductID = $productId";
                        mysqli_query($conn, $updateStockQuery);
                    }
                }

                // Delete the order
                $orderDelete = delete('orders', 'TrackingNo', $id);
                if ($orderDelete) {
                    redirect('orders.php', 'Order cancelled.');
                } else {
                    redirect('orders.php', 'Something went wrong while deleting the order.');
                }
            } else {
                redirect('orders.php', 'Order not found.');
            }
        } else {
            redirect('orders.php', 'Invalid ID format.');
        }
    } else {
        redirect('orders.php', 'Record does not exist.');
    }
} else {
    redirect('orders.php', 'No ID Received.');
}
