<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Orders</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Order Details
                <a href="orders-create.php" class="btn btn-primary float-end">Create Order</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tracking No.</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Payment Mode</th>
                            <th class="text-center">Action</th>
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
                                            <?php if ($item['OrderStatus'] !== 'Completed' && $item['OrderStatus'] !== 'Cancelled') : ?>
                                                <a href="orders-cancel.php?id=<?= $item['TrackingNo'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Cancel this order?')">Cancel Order</a>
                                            <?php endif; ?>
                                            <a href="orders-view.php?track=<?= $item['TrackingNo'] ?>" class="btn btn-info btn-sm">View</a>
                                            <?php if ($item['OrderStatus'] !== 'Cancelled') : ?>
                                                <a href="orders-status.php?id=<?= $item['TrackingNo'] ?>&action=toggle_status" class="btn <?= $item['OrderStatus'] == 'Completed' ? 'btn-warning' : 'btn-success' ?> btn-sm">
                                                    <?= ($item['OrderStatus'] == 'Completed') ? 'Mark as Pending' : 'Mark as Complete' ?>
                                                </a>
                                                <a href="orders-view-print.php?track=<?= $item['TrackingNo'] ?>" class="btn btn-secondary btn-sm">Print</a>
                                            <?php else : ?>
                                                <a href="orders-restore.php?id=<?= $item['TrackingNo'] ?>" class="btn btn-primary btn-sm">Restore</a>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php
                                endforeach;
                            } else {
                                ?>
                                <tr>
                                    <td></td>
                                    <td colspan="7">No existing record.</td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>