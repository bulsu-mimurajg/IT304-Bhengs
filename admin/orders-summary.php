<?php include('includes/header.php');
if (!isset($_SESSION['productItems'])) {
    echo '<script>window.location.href = "orders-create.php"</script>';
}
?>

<div class="modal" tabindex="-1" id="orderSuccess" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Order successfully created.</p>
            </div>
            <div class="modal-footer">
                <a href="orders.php" class="btn btn-secondary">Close</a>
                <button type="button" class="btn btn-warning px-5" onclick="printReceipt()"> Print </button>
            </div>
        </div>
    </div>
</div>

<div class=" container-fluid px-4">
    <h1 class="mt-3">Order Summary</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow">
                <div class="card-header">
                    <h4 class="mb-0">Order Details
                        <a href="orders-create.php" class="btn btn-danger float-end">Cancel</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php alertMessage(); ?>
                    <div id="receipt">
                        <?php
                        if (isset($_SESSION['phone'])) {
                            $phone = validate($_SESSION['phone']);
                            $invoiceNo = validate($_SESSION['invoice_no']);

                            $query = mysqli_query($conn, "SELECT * FROM customer WHERE Phone='$phone' LIMIT 1");
                            if ($query) {
                                if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
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
                                                    <p style="line-height:20px;margin:0;padding:0;">Invoice number: <?= $invoiceNo ?></p>
                                                    <p style="line-height:20px;margin:0;padding:0;">Invoice Date: <?= date('d M y') ?></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                        <?php
                                } else {
                                    echo "<h5>Customer does not exist OWW</h5>";
                                    return;
                                }
                            }
                        }
                        ?>

                        <?php
                        if (isset($_SESSION['productItems'])) {
                            $sessionProducts = $_SESSION['productItems'];
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
                                        $totalAmount = 0;
                                        foreach ($sessionProducts as $key => $row) :
                                            $totalAmount += $row['Price'] * $row['Quantity']
                                        ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc"><?= $i++ ?></td>
                                                <td style="border-bottom: 1px solid #ccc"><?= $row['ProductName'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc"><?= number_format($row['Price'], 0) ?></td>
                                                <td style="border-bottom: 1px solid #ccc"><?= $row['Quantity'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc">
                                                    <?= number_format($row['Price'] * $row['Quantity'], 0) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4" align="end" style="font-weight:bold;">Total: </td>
                                            <td colspan="1" style="font-weight:bold;"><?= number_format($totalAmount, 0) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Payment Mode: <?= $_SESSION['payment_mode'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                            echo "<h5>Customer does not exist OWW</h5>";
                        }
                        ?>
                    </div>
                    <?php if (isset($_SESSION['productItems'])) : ?>
                        <div class="mt-4 text-center">
                            <button tpye="button" class="btn btn-success px-5" id="saveOrder">Save</button>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>