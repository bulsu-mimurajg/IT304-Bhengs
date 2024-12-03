<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/css/orders.css">

<div class="user-page">
  <?php include('includes/sidebar.php'); ?>

  <div class="main-content">
    <section class="content">
      <h2 class="text-start">My Orders</h2>

      <!-- Customer-friendly info box -->
      <div class="info-box">
        <h3>Hello, <?= $_SESSION['loggedInUser']['FName'] . ' ' . $_SESSION['loggedInUser']['LName'] ?>!</h3>
        <p>Here’s a summary of your orders. You can view the details of each order or check their status below.</p>
      </div>

      <!-- Orders Table -->
      <table class="orders-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Tracking No</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT o.*, c.* FROM orders o JOIN customer c ON o.CustomerID = c.CustomerID WHERE o.CustomerID = {$_SESSION['loggedInUser']['CustomerID']} ORDER BY o.OrderID DESC;";
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
                  <td><?= date('d M, Y', strtotime($item['OrderDate'])) ?></td>
                  <td>PHP <?= number_format($item['TotalPrice'], 0) ?></td>
                  <td><?= $item['OrderStatus'] ?></td>
                  <td>
                    <?php if ($item['OrderStatus'] !== 'Delivered') : ?>
                      <a href="orders-cancel.php?id=<?= $item['TrackingNo'] ?>" class="btn btn-sm"
                        onclick="return confirm('Cancel this order?')">Cancel Order</a>
                    <?php endif; ?>
                    <a href="orders-view.php?track=<?= $item['TrackingNo'] ?>" class="btn btn-sm">View</a>
                    <a href="orders-view-print.php?track=<?= $item['TrackingNo'] ?>" class="btn btn-sm">Print</a>
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
    </section>
  </div>
</div>
<?php include('includes/footer.php'); ?>