<?php

include('../config/function.php');

if (isset($_POST['saveCustomer'])) {
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $address = validate($_POST['address']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $confirmPassword = validate($_POST['confirmPassword']);

    if (
        // CHECK FIELDS IF ARE EMPTY
        $fname != '' && $lname != '' && $address != '' && $email != '' &&
        $phone != '' && $password != '' && $confirmPassword != ''
    ) {
        //CHECK IF EMAIL IS TAKEN
        $emailCheck = mysqli_query($conn, "SELECT * FROM customer WHERE Email='$email'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('customer-create.php', 'Email already used.');
            }
        }
        //CHECK IF PASSWORD DO NOT MATCH
        if (trim($password) != trim($confirmPassword)) {
            redirect('customer-create.php', 'Passwords do not match.');
        }
        $password = password_hash($password, PASSWORD_DEFAULT);

        $dataToInsert = [
            'FName' => $fname,
            'LName' => $lname,
            'Address' => $address,
            'Email' => $email,
            'Phone' => $phone,
            'Password' => $password
        ];

        $result = insert('customer', $dataToInsert);
        if ($result) {
            redirect('customer.php', 'Customer succesfully created.');
        } else {
            redirect('customer-create.php', 'Something went wrong...');
        }
    } else {
        redirect('customer-create.php', 'Please fill in all fields.');
    }
}

if (isset($_POST['updateCustomer'])) {
    $customerID = validate($_POST['customerID']);
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $address = validate($_POST['address']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $confirmPassword = validate($_POST['confirmPassword']);

    // Fetch the current customer data
    $response = getById('customer', 'CustomerID', $customerID);
    if ($response['status'] !== 200) {
        redirect('customer.php', 'Customer record not found.');
    }
    $currentCustomerData = $response['data'];

    // Get new values from the form
    $newCustomerData = [
        'FName' => $fname,
        'LName' => $lname,
        'Address' => $address,
        'Email' => $email,
        'Phone' => $phone,
        'Password' => $password,
    ];

    // Prepare data for update
    $columnToUpdate = [];

    foreach ($newCustomerData as $column => $value) {
        if ($column === 'Email') {
            if (!empty($value) && $value != $currentCustomerData['Email']) {
                $emailCheck = mysqli_query($conn, "SELECT * FROM customer WHERE Email='$email'");
                if ($emailCheck) {
                    if (mysqli_num_rows($emailCheck) > 0) {
                        redirect('customer-edit.php?id=' . $customerID, 'Email already used.');
                    }
                }
                $columnToUpdate['Email'] = $value;
            }
        } elseif ($column === 'Password') {
            if (!empty($value) && !password_verify($value, $currentCustomerData['Password'])) {
                $columnToUpdate['Password'] = password_hash($value, PASSWORD_DEFAULT);
            }
        } elseif (!empty($value) && $value !== $currentCustomerData[$column]) {
            // Skip empty fields and unchanged fields
            $columnToUpdate[$column] = $value;
        }
    }

    // Handle password validation
    if (!empty($newCustomerData['Password']) && $newCustomerData['Password'] !== $confirmPassword) {
        redirect('customer-edit.php?id=' . $customerID, 'Passwords do not match.');
    }

    // Perform update if there are changes
    if (!empty($columnToUpdate)) {
        $result = update('customer', 'CustomerID', $customerID, $columnToUpdate);
        if ($result) {
            redirect('customer.php', 'Customer successfully updated.');
        } else {
            redirect('customer-edit.php?id=' . $customerID, 'Something went wrong.');
        }
    } else {
        // No changes detected
        redirect('customer-edit.php?id=' . $customerID, 'No changes were made.');
    }
}
