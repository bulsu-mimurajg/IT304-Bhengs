<?php

include('config/function.php');

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM customer WHERE Email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['Password'];

                if (!password_verify($password, $hashedPassword)) {
                    redirect('login.php', 'Username or password is incorrect.');
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'CustomerID' => $row['CustomerID'],
                    'FName' => $row['FName'],
                    'LName' => $row['LName'],
                    'Address' => $row['Address'],
                    'Email' => $row['Email'],
                    'Phone' => $row['Phone'],
                ];

                header('Location: customer/index.php');
            } else {
                redirect('login.php', 'Username or password is incorrect.');
            }
        } else {
            redirect('login.php', 'Username or password is incorrect.');
        }
    } else {
        redirect('login.php', 'Fill in all fields.');
    }
} else {
    redirect('login.php', 'Something went wrong.');
}
