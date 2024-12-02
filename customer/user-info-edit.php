<?php include 'includes/header.php' ?>

<link rel="stylesheet" href="assets/css/user-info.css">

<div class="main-content">
    <div class="form-container">
        <h2>Account Info</h2>
        <?php alertMessage(); ?>
        <?php
        if (isset($_SESSION['loggedInUser']['CustomerID'])) {
            $id = validate($_SESSION['loggedInUser']['CustomerID']);

            $response = getById('customer', 'CustomerID', $id);
            if ($response['status'] === 200) {
                $customer = $response['data'];
            } elseif ($response['status'] === 404) {
                echo '<h5>' . $response['message'] . '</h5>';
                return false;
            } elseif ($response['status'] === 500) {
                echo '<h5>' . $response['message'] . '</h5>';
                return false;
            } else {
                echo '<h5>Something went wrong. (CUSTOMER-EDIT)</h5>';
                return false;
            }
        } else {
            echo '<h5>No ID received.</h5>';
            return false;
        }
        ?>
        <form action="user-info-function.php" method="POST">
            <input type="hidden" name="customerID" value="<?= $customer['CustomerID'] ?>" class="form-control">
            <div class="form-row side-by-side">
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="surname" value="<?= $customer['LName'] ?>">
                </div>
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" value="<?= $customer['FName'] ?>">
                </div>
            </div>

            <label for="contact-no">Contact No.:</label>
            <input type="text" id="contact-no" name="contact-no" value="<?= $customer['Phone'] ?>">

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= $customer['Address'] ?>">

            <label for="email">E-mail Address:</label>
            <input type="email" id="email" name="email" value="<?= $customer['Email'] ?>">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="confirmPassword" id="confirmPassword">

            <div class="center-btn">
                <button class="edit-button" type="button" onclick="BackToUserInfo()">Back</button>
                <script>
                    function BackToUserInfo() {
                        window.location.href = 'user-info.php';
                    }
                </script>
                <button class="edit-button" type="submit" name="updateInfo">Save</button>
            </div>
        </form>
    </div>
</div>

<?php include('./includes/footer.php'); ?>