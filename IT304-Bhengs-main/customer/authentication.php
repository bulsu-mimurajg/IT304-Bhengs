<?php
if (isset($_SESSION['loggedIn'])) {
    $customerID = validate($_SESSION['loggedInUser']['CustomerID']);

    // Redirect admin users to the admin dashboard (absolute URL)
    if ($customerID == 1) {
        redirect('/website/admin/index.php', 'Access denied. Customers only.');
    }
} else {
    // Redirect to login if not logged in
    redirect('/website/login.php', 'Login to continue...');
}
