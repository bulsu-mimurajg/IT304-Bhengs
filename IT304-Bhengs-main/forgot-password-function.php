<?php

include('config/function.php');

if (isset($_POST['forgotPassword'])) {
    $password = rand(111111, 999999);
    $email = validate($_POST['email']);

    $query = "SELECT CustomerID, Email FROM customer WHERE Email='$email' LIMIT 1";
    $response = mysqli_query($conn, $query);

    if (!$response || mysqli_num_rows($response) <= 0) {
        redirect('forgot-password.php', 'Email does not exist');
    }

    $row = mysqli_fetch_assoc($response);
    $id = $row['CustomerID'];
    $newPassword = password_hash($password, PASSWORD_DEFAULT);

    $updateQuery = "UPDATE customer SET Password = '$newPassword' WHERE CustomerID = '$id'";
    if (!mysqli_query($conn, $updateQuery)) {
        redirect('forgot-password.php', 'Failed to update password. Please try again later.');
    }

    $message = 'Hey!<br><br>Your new password is: ' . $password;
    mailToUser($email, "Forgot Password", $message);

    redirect('forgot-password.php', 'Instructions sent to email');
}
