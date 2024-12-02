<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="assets/css/menu.css">

<div class="container-md px-4">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-9 mt-5 me-5">
            <div class="card">
                <div class="card-header">
                    <?php include('includes/secondary-navbar.php'); ?>
                </div>
                <div class="card-body">
                    <div class="row row-cols-4 justify-content-center">
                        <?php
                        $query = "SELECT p.* FROM product p JOIN product_category pc ON p.CategoryID = pc.CategoryID WHERE pc.CategoryName != 'Filipino';";
                        $menu = mysqli_query($conn, $query);
                        if ($menu) {
                            if (mysqli_num_rows($menu) > 0) {
                                foreach ($menu as $item) :
                        ?>
                                    <div class="col d-flex align-items-stretch mt-5 text-center">
                                        <div class="card">
                                            <img src="..<?= $item['ProductImage'] ?>" class="card-img-top img-fluid" height="100" alt="<?= $item['ProductName'] ?>">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title"><?= $item['ProductName'] ?></h5>
                                                <p class="card-text">₱ <?= $item['Price'] ?></p>
                                                <a href="#" class="btn btn-danger mt-auto add-to-cart"
                                                    data-product-id="<?= $item['ProductID'] ?>"
                                                    data-product-name="<?= $item['ProductName'] ?>"
                                                    data-product-price="<?= $item['Price'] ?>"
                                                    data-product-image="..<?= $item['ProductImage'] ?>">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                            } else {
                                ?>
                                <h5>No Product Found.</h5>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>