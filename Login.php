
<?php include('includes/header.php'); ?>
 <!-- BOXICONS -->
 <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

 <!-- CSS -->
 <link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/login.css">
<link rel="stylesheet" href="assets/css/sign-up.css">

 <!-- SWIPER CSS -->
 <link rel="stylesheet" href="sassets/css/swiper-bundle.min.css" />
</head>

<main class="login">  
        <div class="parallax parallax-1"></div>
        <div class="content centered">
         <div class="loginBox">
          <h1>Login</h1>
          <div class="userPassContainer">
              <label for="EmailInput">Email:</label>
              <input type="text" id="EmailInput" placeholder="Enter email" required>
              
              <label for="PasswordInput">Password:</label>
              <input type="password" id="PasswordInput" placeholder="Enter password" required>         
          </div>
  
          <div class="forgot_pass">
              <a href="forgot_Password.php">Forgot Pasword?</a>
          </div>
  
          <div class="hrefContainer">       
            
            <button class="btn-login">Login</button>
        </div>
        <div class="display-4">
          <hr>
        </div>
        
            <div class="gotta-signup">
            <span> Don't have an account? <span>
            <a href="signup.php">Sign-up</a>     
          </div>
        </div>
      
  </main>     
