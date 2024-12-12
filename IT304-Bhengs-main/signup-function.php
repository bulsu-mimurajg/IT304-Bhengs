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
        // CHECK IF ADDRESS IS WITHIN MALOLOS
        if (!preg_match('/\bmalolos\b/i', $address)) {
            redirect('signup.php', 'Sorry! We only operate within Malolos.');
        }
        //CHECK IF EMAIL IS TAKEN
        $emailCheck = mysqli_query($conn, "SELECT * FROM customer WHERE Email='$email' LIMIT 1");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('signup.php', 'Email already used.');
            }
        }

        // Check IF PASSWORD CONTAINS
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', trim($password))) {
            redirect('signup.php', '<h6>Password must be at least 8 characters long, contain at least one uppercase letter, and at least one number.</h6>');
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
            $msg = "Welcome, <b>" . $fname . "!</b><br><br>You are now registered with Bhengs Homemade <3";
            mailToUser($email, "Account Creation", $msg);
            redirect('login.php', 'Account creation successful');
        } else {
            redirect('signup.php', 'Something went wrong...');
        }
    } else {
        redirect('signup.php', 'Please fill in all fields.');
    }
}
