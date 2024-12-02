<?php $currentPage = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); ?>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-md column-gap-4">
        <a class="navbar-brand" href="#">
            <img src="./assets/img/3.png" width="150px" class="image-fluid" alt="">
        </a>
        <div class="d-lg-none ms-auto">
            <button type="button" class="btn">Log In</button>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav column-gap-2 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>" aria-current="page">Home</a>
                </li>
                <li class="nav-item">
                    <a href="menu-guest.php" class="nav-link <?= $currentPage == 'menu-guest.php' ? 'active' : '' ?>">Menu</a>
                </li>
            </ul>
        </div>
        <div class="d-none d-lg-block ms-auto">
            <a href="login.php" class="btn <?= ($currentPage == 'login.php') || ($currentPage == 'signup.php') || ($currentPage == 'forgot-password.php') ? 'gone' : '' ?>" href="orders.php">Login</a>
        </div>
    </div>
</nav>