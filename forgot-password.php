<?php include('./includes/header.php'); ?>

<link rel="stylesheet" href="assets/css/forgot-password.css">


<div class="forgotPassword">
  <div class="parallax parallax-1"></div>
  <div class="content centered">
    <div class="forgotBox">
      <a href="login.php"><i class="ri-arrow-left-circle-line"></i></a>
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
  </div>
</div>

<?php include('./includes/footer.php'); ?>