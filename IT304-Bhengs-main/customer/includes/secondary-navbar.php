<?php $currentPage = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1) ?>
<link rel="stylesheet" href="assets/css/secondary-navbar.css">

<div class="col text-end second">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid align-items-center justify-content-center">
            <h5 class="navbar-brand" href="#">Category</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mx-2 px-5 btn <?= $currentPage == 'menu-all.php' ? 'active' : '' ?>" href="menu-all.php">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 px-3 btn <?= $currentPage == 'menu-korean.php' ? 'active' : '' ?>" href="menu-korean.php">Korean</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 px-3 btn <?= $currentPage == 'menu-filipino.php' ? 'active' : '' ?>" href="menu-filipino.php">Filipino</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 px-3 btn <?= $currentPage == 'menu-specials.php' ? 'active' : '' ?>" href="menu-specials.php">Specials</a>
                    </li>
                </ul>
            </div>
            <button class="btn btn-danger ms-md-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                My Cart
            </button>
        </div>
    </nav>
</div>


<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">My Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Your cart is empty</p>
    </div>
    <button type="button" class="btn btn-danger text-center mx-5 my-3" id="placeOrder">Place Order</button>
</div>