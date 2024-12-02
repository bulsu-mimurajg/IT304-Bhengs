<?php $currentPage = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1) ?>

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
                    <a class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage == 'menu-all.php' ? 'active' : '' ?>" href="menu-all.php">Menu</a>
                </li>
            </ul>
            <ul class="navbar-nav column-gap-2 ms-auto mb-2 mb-lg-0 justify-content-center align-items-center">
                <span class="navbar-text fs-6 fw-bold" style="color: #f3156b">
                    Welcome,
                </span>
                <li class="nav-item text-info me-5 fw-bold"><?= $_SESSION['loggedInUser']['FName'] ?>
                </li>
                <li class="nav-item d-none d-lg-block ms-auto">
                    <a href="user-info.php" class="btn fw-bold"><i class="ri-user-line"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>