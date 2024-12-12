<?php

include('../config/function.php');

// WALANG PRODUCT NAME CHECK IF EXISTS SA CREATE PERO SA UPDATE MEORN HAAAHHAHAHA baliwwww
if (isset($_POST['saveProduct'])) {
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    // $image = validate($_POST['price']);

    if ($price <= 0) {
        redirect('products-create.php', 'Price cannot be negative.');
        exit;
    }

    if ($quantity <= 0) {
        redirect('products-create.php', 'Quantity cannot be negative.');
        exit;
    }

    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/img/uploads/products/";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = time() . '.' . $image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path . '' . $fileName);

        $finalImage = '/assets/img/uploads/products/' . $fileName;
    } else {
        $finalImage = '';
    }

    $dataToInsert = [
        'ProductName' => $name,
        'Price' => $price,
        'Quantity' => $quantity,
        'ProductImage' => $finalImage,
        'CategoryID' => $category_id
    ];

    $result = insert('product', $dataToInsert);
    if ($result) {
        redirect('products.php', 'Product succesfully created.');
    } else {
        redirect('products-create.php', 'Something went wrong...');
    }
}

if (isset($_POST['updateProduct'])) {
    $productId = validate($_POST['productID']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);

    $response = getById('product', 'ProductID', $productId);
    if ($response['status'] !== 200) {
        redirect('product.php', 'Product record not found.');
    }
    $currentProductData = $response['data'];

    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/img/uploads/products/";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = time() . '.' . $image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path . '' . $fileName);

        $finalImage = '/assets/img/uploads/products/' . $fileName;

        $deleteImage = '../' . $currentProductData['ProductImage'];
        if (file_exists($deleteImage)) {
            unlink($deleteImage);
        }
    } else {
        $finalImage = '';
    }


    // Get new values from the form
    $newProductData = [
        'ProductName' => $name,
        'Price' => $price,
        'Quantity' => $quantity,
        'ProductImage' => $finalImage
    ];

    // Prepare data for update
    $columnToUpdate = [];
    foreach ($newProductData as $column => $value) {
        if ($column === 'ProductName') {
            if (!empty($value) && $value != $currentProductData['ProductName']) {
                $productCheck = mysqli_query($conn, "SELECT * FROM product WHERE ProductName='$name'");
                if ($productCheck) {
                    if (mysqli_num_rows($productCheck) > 0) {
                        redirect('products-edit.php?id=' . $productId, 'Product name already exists.');
                    }
                }
                $columnToUpdate['ProductName'] = $value;
            }
        } elseif ($value !== $currentProductData[$column]) {
            // Skip empty fields and unchanged fields
            $columnToUpdate[$column] = $value;
        }
    }

    if (!empty($columnToUpdate)) {
        $result = update('product', 'ProductID', $productId, $columnToUpdate);
        if ($result) {
            redirect('products.php', 'Product sucessfully updated.');
        } else {
            redirect('products-edit.php?id=' . $productId, 'Something went wrong.');
        }
    } else {
        // No changes detected
        redirect('products-edit.php?id=' . $productId, 'No changes were made.');
    }
}
