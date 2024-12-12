<?php

require '../config/function.php';

if (isset($_GET['id'])) {
    if ($_GET['id']) {
        $id = validate($_GET['id']);

        if (is_numeric($id)) {
            $category = getById('product_category', 'CategoryID', $id);
            if ($category['status'] == 200) {
                $categoryDelete = delete('product_category', 'CategoryID', $id);
                if ($category) {
                    redirect('categories.php', 'Category successfully deleted.');
                } else {
                    redirect('categories.php', 'Something went wrong.');
                }
            }
        }
    } else {
        redirect('categories.php', 'Record does not exist.');
    }
} else {
    redirect('categories.php', 'No Id Received.');
}
