<?php

include('config/function.php');

if (isset($_POST['register'])) {
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
        $emailCheck = mysqli_query($conn, "SELECT * FROM customer WHERE Email='$email' LIMIT 1");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('signup.php', 'Email already used.');
            }
        }
        //CHECK IF PASSWORD DO NOT MATCH
        if (trim($password) != trim($confirmPassword)) {
            redirect('signup.php', 'Passwords do not match.');
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
            redirect('login.php', 'Account succesfully created.');
        } else {
            redirect('signup.php', 'Something went wrong...');
        }
    } else {
        redirect('signup.php', 'Please fill in all fields.');
    }
}
