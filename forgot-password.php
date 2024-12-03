<?php include('./includes/header.php'); ?>

<link rel="stylesheet" href="assets/css/forgot-password.css">


<div class="forgotPassword">
  <div class="parallax parallax-1"></div>
  <div class="content centered">
    <div class="forgotBox">
      <?php alertMessage() ?>
      <a href="login.php"><i class="ri-arrow-left-circle-line"></i></a>
      <h1>Forgot Password</h1>
      <div class="userPassContainer">
        <form action="forgot-password-function.php" method="POST">
          <label for="EmailInput">Email:</label>
          <input type="email" id="EmailInput" name="email" placeholder="Enter email" required>
          <p class="note">Note: We will send instructions to the email address you provided.</p>
          <div class="hrefContainer">
            <button type="submit" name="forgotPassword" class="btn-forgotPass">Send </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('./includes/footer.php'); ?>