<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/css/orders.css">
<!-- <link rel="stylesheet" href="assets/css/1.css">/ -->

<div class="container-fluid px-4">
    <?php include('includes/sidebar.php'); ?>
    <div class="card shadow" style="margin-top: 7rem;max-width: 79%;">
        <div class="card-header">
            <h4 class="mb-0">Order Details
                <a href="orders.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['track'])) {
                $trackingNo = validate($_GET['track']);

                $query = "SELECT o.*, c.* FROM orders o JOIN customer c ON o.CustomerID = c.CustomerID 
                WHERE o.TrackingNo = '$trackingNo' ORDER BY o.OrderID DESC;";

                $orders = mysqli_query($conn, $query);
                if ($orders) {
                    if (mysqli_num_rows($orders) > 0) {
                        $orderData = mysqli_fetch_assoc($orders);
                        $orderId = $orderData['OrderID'];
            ?>
                        <div class="row p-4">
                            <div class="col-md-5">
                                <h4>Order Details</h4>
                                <label class="mb-1">
                                    Tracking No:
                                    <span class="fw-bold"><?= $orderData['TrackingNo'] ?></span>
                                </label>
                                <br>
                                <label class="mb-1">
                                    Date:
                                    <span class="fw-bold"><?= $orderData['OrderDate'] ?></span>
                                </label>
                                <br>
                                <label class="mb-1">
                                    Status:
                                    <span class="fw-bold text-capitalize"><?= $orderData['OrderStatus'] ?></span>
                                </label>
                                <br>
                                <label class="mb-1">
                                    Payment Mode:
                                    <span class="fw-bold"><?= $orderData['PaymentMode'] ?></span>
                                </label>
                            </div>
                            <div class="col-md-5">
                                <h4>Customer Details</h4>
                                <label class="mb-1">
                                    Full Name:
                                    <span class="fw-bold"><?= $orderData['FName'] . ' ' . $orderData['LName'] ?></span>
                                </label>
                                <br>
                                <label class="mb-1">
                                    Email Address:
                                    <span class="fw-bold"><?= $orderData['Email'] ?></span>
                                </label>
                                <br>
                                <label class="mb-1">
                                    Phone Number:
                                    <span class="fw-bold text-capitalize"><?= $orderData['Phone'] ?></span>
                                </label>
                                <br>
                            </div>
                            <?php
                            $orderItemQuery = "SELECT oi.Quantity as orderItemQuantity, oi.Price as orderItemPrice, o.*, oi.*, p.* FROM orders as o, order_items as oi, product as p 
                                    WHERE oi.OrderID = o.OrderID AND p.ProductID = oi.ProductID AND o.TrackingNo='$trackingNo'";

                            $orderItemResult = mysqli_query($conn, $orderItemQuery);
                            if ($orderItemResult) {
                                if (mysqli_num_rows($orderItemResult) > 0) {
                            ?>
                                    <h4 class="my-3">Ordered Items</h4>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orderItemResult as $item) : ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?= $item['ProductImage'] != '' ? '../' . $item['ProductImage'] : 'No Product Image' ?>" alt="Product Image" style="width:50px; height: 50px;">
                                                        <?= $item['ProductName'] ?>
                                                    </td>
                                                    <td width="15%" class="fw-bold text-center">
                                                        <?= number_format($item['orderItemPrice'], 0) ?>
                                                    </td>
                                                    <td width="15%" class="fw-bold text-center">
                                                        <?= $item['orderItemQuantity'] ?>
                                                    </td>
                                                    <td width="15%" class="fw-bold text-center">
                                                        <?= number_format($item['orderItemPrice'] * $item['orderItemQuantity'], 0) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>

                                            <tr>
                                                <td class="text-end fw-bold">Total Price: </td>
                                                <td colspan="3" class="text-end fw-bold">PHP <?= number_format($item['TotalPrice'], 0) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                <?php
                                } else {
                                    echo "<h5>Item does not exist.</h5>";
                                }
                            } else {
                                echo "<h5>Something went wrong.</h5>";
                                return false;
                            }
                        } else {
                            echo "<h5>Order does not exist.</h5>";
                        }
                    } else {
                        echo "<h5>Something went wrong.</h5>";
                    }
                }
                ?>
                        </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>