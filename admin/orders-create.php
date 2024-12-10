<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Create Order</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Order Details
                <a href="orders.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="orders-function.php" method="POST">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="product" class="form-label">Product</label>
                        <select name="productId" id="product" class="form-select">
                            <option value="" disabled selected>-- Select Product --</option>
                            <?php
                            $products = getAll('product');
                            if ($products) {
                                if (mysqli_num_rows($products) > 0) {
                                    foreach ($products as $item) {
                            ?>
                                        <option value="<?= $item['ProductID'] ?>"><?= $item['ProductName'] ?></option>;
                            <?php
                                    }
                                } else {
                                    echo '<option value="">No product found.</option>';
                                }
                            } else {
                                echo 'option value="">Something went wrong.</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" name="addItem" class="btn btn-success float-end px-5">Add Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header py-3">
            <h4 class="mb-0">Products</h4>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['productItems'])) {
                $sessionProducts = $_SESSION['productItems'];
                if (empty($sessionProducts)) {
                    unset($_SESSION['productItemIds']);
                    unset($_SESSION['productItems']);
                    // echo '<script>windows.location.href = "orders-create.php"</script>';
                    echo '<script>location.reload();</script>';
                }
            ?>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sessionProducts as $key => $item) : ?>
                                <tr>
                                    <td><?= $item['ProductName'] ?></td>
                                    <td><?= $item['Price'] ?></td>
                                    <td>
                                        <div class="input-group qtyBox">
                                            <input type="hidden" value="<?= $item['ProductID'] ?>" class="prodId">
                                            <button class="input-group-text decrement">-</button>
                                            <input type="text" value="<?= $item['Quantity'] ?>" class="qty quantityInput">
                                            <button class="input-group-text increment">+</button>
                                        </div>
                                    </td>
                                    <td><?= number_format($item['Price'] * $item['Quantity'], 0) ?></td>
                                    <td>
                                        <a href="orders-item-delete.php?index=<?= $key ?>" class="btn btn-danger">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-2">
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="payment_mode">Payment Mode</label>
                            <select id="payment_mode" class="form-select">
                                <option value="">-- Select Payment Option --</option>
                                <option value="GCash">GCash</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Phone Number</label>
                            <input type="number" name="" id="phone" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <br>
                            <button type="button" class="btn btn-warning placeOrder">Place Order</button>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                echo "<h5> No Item Added</h5>";
            }
            // print_r($_SESSION['productItems']);
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>