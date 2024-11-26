<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Create Order</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Order Details
                <a href="orders-create.php" class="btn btn-primary float-end">Create Order</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tracking No.</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Payment Mode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $query = "SELECT o.*, c.* FROM orders o JOIN customer c ON o.CustomerID = c.CustomerID ORDER BY o.OrderID DESC;";
                        $orders = mysqli_query($conn, $query);
                        if ($orders) {
                            if (mysqli_num_rows($orders) > 0) {
                                $count = 0;
                                foreach ($orders as $item) :
                                    $count++;
                        ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td class="fw-bold"><?= $item['TrackingNo'] ?></td>
                                        <td><?= $item['FName'] . ' ' . $item['LName'] ?></td>
                                        <td><?= $item['Phone'] ?></td>
                                        <td><?= date('d M, Y', strtotime($item['OrderDate'])) ?></td>
                                        <td><?= $item['OrderStatus'] ?></td>
                                        <td><?= $item['PaymentMode'] ?></td>
                                        <td>
                                            <a href="orders-view.php?track=<?= $item['TrackingNo'] ?>" class="btn btn-info btn-sm">View</a>
                                            <a href="" class="btn btn-danger btn-sm">Print</a>
                                        </td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                        } else {
                            ?>
                            <tr>
                                <td></td>
                                <td colspan="7">No existing record.</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>