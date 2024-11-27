<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Print Order</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Order Details
                <a href="orders.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <div id="receipt">
                <?php
                if (isset($_GET['track'])) {
                    $trackingNo = validate($_GET['track']);

                    $query = "SELECT o.*, c.* FROM orders o JOIN customer c ON o.CustomerID = c.CustomerID 
                WHERE o.TrackingNo = '$trackingNo' LIMIT 1";

                    $row = mysqli_query($conn, $query);
                    if ($row) {
                        if (mysqli_num_rows($row) > 0) {
                            $row = mysqli_fetch_assoc($row);
                            $orderId = $row['OrderID'];
                ?>
                            <table style="width: 100%; margin-bottom:20px;">
                                <tbody>
                                    <tr>
                                        <td style="text-align:center;" colspan="2">
                                            <h4 style="line-height:30px;margin:2px;padding:0;">Bhengs Homemade</h4>
                                            <p style="font-size:16px;line-height:24px;margin:2px;padding:0;">Menzyland Subd. Malolos, Bulacan</p>
                                            <p style="line-height:24px;margin:2px;padding:0;">facebook.com/BhengsHomemade</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="line-height:30px;margin:0;padding:0;">Customer Details</h5>
                                            <p style="line-height:20px;margin:0;padding:0;">Name: <?= $row['FName'] . ' ' .  $row['LName'] ?> </p>
                                            <p style="line-height:20px;margin:0;padding:0;">Phone Number: <?= $row['Phone'] ?> </p>
                                            <p style="line-height:20px;margin:0;padding:0;">Email: <?= $row['Email'] ?> </p>
                                        </td>
                                        <td align="end">
                                            <h5 style="line-height:30px;margin:0;padding:0;">Invoice Details</h5>
                                            <p style="line-height:20px;margin:0;padding:0;">Invoice number: <?= $row['InvoiceNo'] ?></p>
                                            <p style="line-height:20px;margin:0;padding:0;">Invoice Date: <?= $row['OrderDate'] ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo "<h5>Order does not exist.</h5>";
                        }

                        $orderItemQuery = "SELECT oi.Quantity as orderItemQuantity, oi.Price as orderItemPrice, o.*, oi.*, p.* FROM orders o JOIN order_items oi ON o.OrderID = oi.OrderID 
                    JOIN product p ON oi.ProductID = p.ProductID WHERE o.TrackingNo='$trackingNo'";

                        $orderItemQueryResult = mysqli_query($conn, $orderItemQuery);
                        if ($orderItemQueryResult) {
                            if (mysqli_num_rows($orderItemQueryResult) > 0) {
                            ?>
                                <div class="table-responsive mb-3">
                                    <table style="width: 100%;" cellpadding="5">
                                        <thead>
                                            <tr>
                                                <th align="start" style="border-bottom:1px solid #ccc;" width="5%">ID</th>
                                                <th align="start" style="border-bottom:1px solid #ccc;">Product Name</th>
                                                <th align="start" style="border-bottom:1px solid #ccc;" width="10%">Price</th>
                                                <th align="start" style="border-bottom:1px solid #ccc;" width="10%">Quantity</th>
                                                <th align="start" style="border-bottom:1px solid #ccc;" width="15%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($orderItemQueryResult as $key => $row) :
                                            ?>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #ccc"><?= $i++ ?></td>
                                                    <td style="border-bottom: 1px solid #ccc"><?= $row['ProductName'] ?></td>
                                                    <td style="border-bottom: 1px solid #ccc"><?= number_format($row['orderItemPrice'], 0) ?></td>
                                                    <td style="border-bottom: 1px solid #ccc"><?= $row['orderItemQuantity'] ?></td>
                                                    <td style="border-bottom: 1px solid #ccc">
                                                        <?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'], 0) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4" align="end" style="font-weight:bold;">Final Total: </td>
                                                <td colspan="1" style="font-weight:bold;"><?= number_format($row['TotalPrice'], 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">Payment Mode: <?= $row['PaymentMode'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                <?php
                            }
                        } else {
                            "<h5>No item ordered.</h5>";
                        }
                    } else {
                        echo "<h5>Something went wrong.</h5>";
                    }
                }
                ?>
            </div>

            <div class="mt-4 text-end">
                <button type="button" class="btn btn-warning px-5" onclick="printReceipt()"> Print </button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>