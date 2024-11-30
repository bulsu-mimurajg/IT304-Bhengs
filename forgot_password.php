<?php include('./includes/header.php'); ?>
 <!-- CSS -->
 <link rel="stylesheet" href="./assets/css/style.css" />
 <link rel="stylesheet" href="./assets/css/login.css"/>
 <link rel="stylesheet" href="./assets/css/sign-up.css">
 <link rel="stylesheet" href="./assets/css/forgotPass.css">


<main class="forgotPassword">
  <div class="parallax parallax-1"></div>
  <div class="content centered">
    <div class="forgotBox">
      <a href="Login.php"><i class="ri-arrow-left-circle-line"></i></a>
      <h1>Forgot Password</h1>
      <div class="userPassContainer">
        <label for="EmailInput">Email:</label>
        <input type="text" id="EmailInput" placeholder="Enter email" required>
        <p class="note">Note: We will send instructions to the email linked on this username</p>

        <div class="hrefContainer">
          <button class="btn-forgotPass">Send </button>
        </div>
      </div>
    </div>

</main>