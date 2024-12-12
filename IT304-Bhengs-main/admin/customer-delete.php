<?php

require '../config/function.php';

if (isset($_GET['id'])) {
    if ($_GET['id']) {
        $id = validate($_GET['id']);

        if (is_numeric($id)) {
            $customer = getById('customer', 'CustomerID', $id);
            if ($customer['status'] == 200) {
                $customerDelete = delete('customer', 'CustomerID', $id);
                if ($customer) {
                    redirect('customer.php', 'Customer successfully deleted.');
                } else {
                    redirect('customer.php', 'Something went wrong.');
                }
            }
        }
    } else {
        redirect('customer.php', 'Record does not exist.');
    }
} else {
    redirect('customer.php', 'No Id Received.');
}
