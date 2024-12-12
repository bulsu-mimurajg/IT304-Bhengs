<?php include('includes/header.php');

if (isset($_SESSION['loggedIn'])) {
?>
  <script>
    window.location.href = 'customer/index.php';
  </script>
<?php
}
?>

<link rel="stylesheet" href="assets/css/login.css">

<div class="login">
  <div class="parallax parallax-1"></div>
  <div class="content centered">
    <div class="loginBox">
      <?php alertMessage() ?>
      <h1>Login</h1>
      <form action="login-function.php" method="POST">
        <div class="userPassContainer">
          <label for="EmailInput">Email:</label>
          <input type="text" name="email" id="EmailInput" placeholder="Enter email">

          <label for="PasswordInput">Password:</label>
          <input type="password" name="password" id="PasswordInput" placeholder="Enter password">
        </div>

        <div class="forgot_pass">
          <a href="forgot-password.php">Forgot Pasword?</a>
        </div>

        <div class="hrefContainer">
          <button type="submit" name="loginBtn" class="btn-login">Login</button>
        </div>
        <div class="display-4">
          <hr>
        </div>

        <div class="gotta-signup">
          <span> Don't have an account? <span>
              <a href="signup.php">Sign-up</a>
        </div>
      </form>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>