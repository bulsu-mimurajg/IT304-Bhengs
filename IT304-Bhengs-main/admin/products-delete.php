<?php

require '../config/function.php';

if (isset($_GET['id'])) {
    if ($_GET['id']) {
        $id = validate($_GET['id']);

        if (is_numeric($id)) {
            $product = getById('product', 'ProductID', $id);
            if ($product['status'] == 200) {
                $productDelete = delete('product', 'ProductID', $id);
                if ($product) {
                    $imageDelete = "../" . $product['data']['ProductImage'];
                    if (file_exists($imageDelete)) {
                        unlink($imageDelete);
                    }
                    redirect('products.php', 'Product successfully deleted.');
                } else {
                    redirect('products.php', 'Something went wrong.');
                }
            }
        }
    } else {
        redirect('products.php', 'Record does not exist.');
    }
} else {
    redirect('products.php', 'No Id Received.');
}
