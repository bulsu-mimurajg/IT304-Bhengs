<?php

include('../config/function.php');

if (isset($_POST['updateInfo'])) {
    $customerID = validate($_POST['customerID']);
    $fname = validate($_POST['firstname']);
    $lname = validate($_POST['surname']);
    $address = validate($_POST['address']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['contact-no']);
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
                        redirect('user-info-edit.php', 'Email already used.');
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
        redirect('user-info-edit.php', 'Passwords do not match.');
    }

    // Perform update if there are changes
    if (!empty($columnToUpdate)) {
        $result = update('customer', 'CustomerID', $customerID, $columnToUpdate);
        if ($result) {
            // Fetch the updated user data
            $updatedUser = fetchSingle('customer', 'CustomerID', $customerID);

            // Update the session with new values
            foreach ($updatedUser as $key => $value) {
                $_SESSION['loggedInUser'][$key] = $value;
            }
            redirect('user-info.php', 'User account updated.');
        } else {
            redirect('user-info-edit.php', 'Something went wrong.');
        }
    } else {
        // No changes detected
        redirect('user-info.php', 'No changes were made.');
    }
}
