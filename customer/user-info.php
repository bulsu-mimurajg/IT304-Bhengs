<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/css/user-info.css">
<!-- <link rel="stylesheet" href="assets/css/1.css"> -->

<!-- Secondary Navbar Section -->
<div class="user-page">

    <?php include('includes/sidebar.php'); ?>

    <div class="main-content">
        <div class="profile-container">
            <?php alertMessage(); ?>
            <h2>Account Info</h2>
            <div class="details-container text-primary-emphasis mt-4">
                <p><strong>First Name: </strong> <?= $_SESSION['loggedInUser']['FName'] ?></p>
                <p><strong>Surname:</strong> <?= $_SESSION['loggedInUser']['LName'] ?></p>
                <p><strong>Contact No:</strong> <?= $_SESSION['loggedInUser']['Phone'] ?></p>
                <p><strong>Address:</strong> <?= $_SESSION['loggedInUser']['Address'] ?></p>
                <p><strong>Email Address:</strong> <?= $_SESSION['loggedInUser']['Email'] ?></p>
            </div>
            <div class="text-center mt-5">
                <a href="user-info-edit.php" class="edit-button">Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>