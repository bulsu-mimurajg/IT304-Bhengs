<?php include('./includes/header.php'); ?>

<link rel="stylesheet" href="assets/css/sign-up.css">

<main class="sign-up">
  <div class="parallax parallax-1"></div>
  <div class="content centered">
    <div class="signup-box">
      <?php alertMessage(); ?>
      <h1>Create Account</h1>

      <form action="signup-function.php" method="POST">
        <div class=" signup-content address-group">
          <label>Address:</label>
          <input type="text" name="address" placeholder="Enter address" required>
          <p class="note">Note: City of Malolos only</p>
        </div>

        <div class="signup-content">
          <label>Surname:</label>
          <input type="text" name="lname" placeholder="Enter surname" required>
        </div>

        <div class="signup-content">
          <label>First Name:</label>
          <input type="text" name="fname" placeholder="Enter first name" required>
        </div>

        <div class="signup-content">
          <label>Email Address:</label>
          <input type="email" name="email" placeholder="Enter email" required>
        </div>

        <div class="signup-content">
          <label>Contact No.:</label>
          <input type="text" name="phone" placeholder="Enter contact number" required>
        </div>

        <div class="signup-content">
          <label>Password:</label>
          <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <div class="signup-content">
          <label>Confirm Password:</label>
          <input type="password" name="confirmPassword" placeholder="Confirm password" required>
        </div>

        <div class="hrefContainer">
          <button class="btn-signup" name="register" type="submit">SIGN UP</button>
        </div>
        <div class="display-4">
          <hr>
        </div>
        <div class="gotta-login">
          <span> Already have an account? </span>
          <a href="login.php">Login</a>
        </div>
    </div>
    </form>

  </div>
</main>