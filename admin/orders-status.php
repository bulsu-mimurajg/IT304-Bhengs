<?php
require '../config/function.php';

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'toggle_status') {
    $id = validate($_GET['id']);

    if (is_numeric($id)) {
        $order = getById('orders', 'TrackingNo', $id);
        if ($order['status'] == 200) {
            $currentStatus = $order['data']['OrderStatus'];

            $newStatus = ($currentStatus == 'Completed') ? 'Pending' : 'Completed';

            $updateQuery = "UPDATE orders SET OrderStatus = '$newStatus' WHERE TrackingNo = $id";
            if (mysqli_query($conn, $updateQuery)) {
                redirect('orders.php', 'Order status updated successfully.');
            } else {
                redirect('orders.php', 'Failed to update order status.');
            }
        } else {
            redirect('orders.php', 'Order not found.');
        }
    } else {
        redirect('orders.php', 'Invalid Order ID.');
    }
} else {
    redirect('orders.php', 'Invalid Request.');
}
