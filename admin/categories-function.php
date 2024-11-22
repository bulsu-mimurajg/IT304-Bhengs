<?php

include('../config/function.php');

if (isset($_POST['saveCategory'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);

    $dataToInsert = [
        'CategoryName' => $name,
        'CategoryDescription' => $description
    ];

    $result = insert('product_category', $dataToInsert);
    if ($result) {
        redirect('categories.php', 'Category succesfully created.');
    } else {
        redirect('categories-create.php', 'Something went wrong...');
    }
}

if (isset($_POST['updateCategory'])) {
    $categoryId = validate($_POST['categoryID']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);

    $response = getById('product_category', 'CategoryID', $categoryId);
    if ($response['status'] !== 200) {
        redirect('categories.php', 'Category record not found.');
    }
    $currentCategoryData = $response['data'];

    // Get new values from the form
    $newCategoryData = [
        'CategoryName' => $name,
        'CategoryDescription' => $description
    ];

    // Prepare data for update
    $columnToUpdate = [];
    foreach ($newCategoryData as $column => $value) {
        if ($column === 'CategoryName') {
            if (!empty($value) && $value != $currentCategoryData['CategoryName']) {
                $categoryCheck = mysqli_query($conn, "SELECT * FROM product_category WHERE CategoryName='$name'");
                if ($categoryCheck) {
                    if (mysqli_num_rows($categoryCheck) > 0) {
                        redirect('categories-edit.php?id=' . $categoryId, 'Category name already exists.');
                    }
                }
                $columnToUpdate['CategoryName'] = $value;
            }
        } elseif ($value !== $currentCategoryData[$column]) {
            // Skip empty fields and unchanged fields
            $columnToUpdate[$column] = $value;
        }
    }

    if (!empty($columnToUpdate)) {
        $result = update('product_category', 'CategoryID', $categoryId, $columnToUpdate);
        if ($result) {
            redirect('categories.php', 'Category sucessfully updated.');
        } else {
            redirect('categories-edit.php?id=' . $categoryId, 'Something went wrong.');
        }
    } else {
        // No changes detected
        redirect('categories-edit.php?id=' . $categoryId, 'No changes were made.');
    }
}
