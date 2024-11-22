<?php

include('../config/function.php');

if (isset($_POST['saveProduct'])) {
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    // $image = validate($_POST['price']);

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
