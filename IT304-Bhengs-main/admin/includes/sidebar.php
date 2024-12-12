<?php $currentPage = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1) ?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sidebar-custom" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Sales Report</div>
                <a class="nav-link <?= $currentPage == 'sales-report_summary.php' ? 'active' : '' ?>" href="sales-report_summary.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Summary
                </a>
                <a class="nav-link
                <?= ($currentPage == 'performance_sales-growth.php') || ($currentPage == 'performance_popularity.php') ? 'collapse active' : 'collapsed' ?>"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapsePerformance" aria-expanded="false" aria-controls="collapsePerformance">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-column"></i></div>
                    Performance
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePerformance" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed <?= $currentPage == 'performance_sales-growth.php' ? 'active' : '' ?>" href="performance_sales-growth.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-simple"></i></div>
                            Sales Growth
                        </a>
                        <a class="nav-link collapsed <?= $currentPage == 'performance_popularity.php' ? 'active' : '' ?>" href="performance_popularity.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Popularity
                        </a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Manage Orders</div>
                <a class="nav-link <?= $currentPage == 'orders.php' ? 'active' : '' ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-bag-shopping"></i></div>
                    Orders
                </a>

                <div class="sb-sidenav-menu-heading">Manage Products</div>
                <a class="nav-link <?= $currentPage == 'categories.php' ? 'active' : '' ?>" href="categories.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                    Categories
                </a>
                <a class="nav-link <?= $currentPage == 'products.php' ? 'active' : '' ?>" href="products.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Products
                </a>

                <div class="sb-sidenav-menu-heading">Manage Accounts</div>
                <a class="nav-link <?= $currentPage == 'customer.php' ? 'active' : '' ?>" href="customer.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Customer
                </a>

                <div class="sb-sidenav-menu-heading"></div>
            </div>
        </div>
    </nav>
</div>