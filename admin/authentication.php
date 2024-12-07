<?php
if (isset($_SESSION['loggedIn'])) {
    $customerID = validate($_SESSION['loggedInUser']['CustomerID']);

    // Redirect non-admin users to the login page (absolute URL)
    if ($customerID != 1) {
        redirect('/website/login.php', 'Access denied. Admin only.');
    }
} else {
    // Redirect to login if not logged in
    redirect('/website/login.php', 'Login to continue...');
}
