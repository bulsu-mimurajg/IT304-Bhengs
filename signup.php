<?php include('./includes/header.php'); ?>
 <!-- CSS -->
 <link rel="stylesheet" href="assets/css/style.css" />
 <link rel="stylesheet" href="assets/css/login.css"/>
 <link rel="stylesheet" href="assets/css/sign-up.css">

<main class="sign-up">
    <div class="parallax parallax-1"></div>
    <div class="content centered">
      <div class="signup-box">
        <h1>Create Account</h1>
        
        <div class=" signup-content address-group">
          <label>Address:</label>
          <input type="text" placeholder="Enter address" required>
          <p class="note">Note: City of Malolos only</p>
        </div>

        <form>
          <div class="signup-content">
            <label>Surname:</label>
            <input type="text" placeholder="Enter surname" required>
          </div>

          <div class="signup-content">
            <label>First Name:</label>
            <input type="text" placeholder="Enter first name" required>
          </div>

          <div class="signup-content">
            <label>Email Address:</label>
            <input type="email" placeholder="Enter email" required>
          </div>

          <div class="signup-content">
            <label>Contact No.:</label>
            <input type="text" placeholder="Enter contact number" required>
          </div>

          <div class="signup-content">
            <label>Password:</label>
            <input type="password" placeholder="Enter password" required>
          </div>

          <div class="signup-content">
            <label>Confirm Password:</label>
            <input type="password" placeholder="Confirm password" required>
          </div>

        </form>
        <div class="hrefContainer">
          <button class="btn-signup" type="submit">SIGN UP</button>
        </div>
        <div class="display-4">
          <hr>
        </div>
        <div class="gotta-login">
          <span> Already have an account? </span>
            <a href="Login.php">Login</a>
        </div>

      </div>

    </div>
  </main>
