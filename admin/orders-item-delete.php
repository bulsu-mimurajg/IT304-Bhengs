<?php

require '../config/function.php';

$index = validate($_GET['index']);

if (isset($_SESSION['productItemIds']) && isset($_SESSION['productItems'])) {
    unset($_SESSION['productItemIds'][$index]);
    unset($_SESSION['productItems'][$index]);

    redirect('orders-create.php', 'Item Removed');
} else {
    redirect('orders-create.php', 'Item does not exist');
}
