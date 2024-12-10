<?php include('includes/header.php');
$sessionProducts = $_SESSION['cart'] ?? [];
$paymentMode = $_SESSION['payment_mode'] ?? 'Not specified';
$invoiceNo = $_SESSION['invoice_no'];

function replaceVowels($string)
{
    // Define vowels
    $vowels = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];

    // Replace each vowel with an asterisk
    return str_ireplace($vowels, '*', $string);
}

?>

<link rel="stylesheet" href="assets/css/menu.css">

<div class="modal" tabindex="-1" id="orderSuccess" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Placed</h5>
            </div>
            <div class="modal-body">
                <p>Thank you for ordering!</p>
                <p>We have emailed you the receipt :D</p>
            </div>
            <div class="modal-footer">
                <a href="orders.php" class="btn btn-secondary">Close</a>
                <button type="button" class="btn btn-warning px-5" onclick="printReceipt()"> Print </button>
            </div>
        </div>
    </div>
</div>

<div class=" container-fluid px-4" style="margin-top: 7rem;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow">
                <div class="card-header">
                    <h4 class="mb-0">Order Details
                        <a href="menu-all.php" class="btn btn-danger float-end">Cancel</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php alertMessage(); ?>
                    <div id="receipt">
                        <?php
                        $invoiceNo = validate($_SESSION['invoice_no']);
                        ?>
                        <table style="width: 100%; margin-bottom:20px;">
                            <tbody>
                                <tr>
                                    <td style="text-align:center;" colspan="2">
                                        <h4 style="line-height:30px;margin:2px;padding:0;">Bhengs Homemade</h4>
                                        <p style="font-size:16px;line-height:24px;margin:2px;padding:0;">Menzyland Subd.
                                            Malolos, Bulacan</p>
                                        <p style="line-height:24px;margin:2px;padding:0;">facebook.com/BhengsHomemade
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 style="line-height:30px;margin:0;padding:0;">Customer Details</h5>
                                        <p style="line-height:20px;margin:0;padding:0;">Name:
                                            <?= $_SESSION['loggedInUser']['FName'] . ' ' . $_SESSION['loggedInUser']['LName'] ?>
                                        </p>
                                        <p style="line-height:20px;margin:0;padding:0;">Phone Number:
                                            <?= $_SESSION['loggedInUser']['Phone'] ?> </p>
                                        <p style="line-height:20px;margin:0;padding:0;">Email:
                                            <?= $_SESSION['loggedInUser']['Email'] ?> </p>
                                    </td>
                                    <td align="end">
                                        <h5 style="line-height:30px;margin:0;padding:0;">Invoice Details</h5>
                                        <p style="line-height:20px;margin:0;padding:0;">Invoice number:
                                            <?= $invoiceNo ?></p>
                                        <p style="line-height:20px;margin:0;padding:0;">Invoice Date:
                                            <?= date('d M y') ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="table-responsive mb-3">
                            <table style="width: 100%;" cellpadding="5">
                                <thead>
                                    <tr>
                                        <th align="start" style="border-bottom:1px solid #ccc;" width="5%">ID</th>
                                        <th align="start" style="border-bottom:1px solid #ccc;">Product Name</th>
                                        <th align="start" style="border-bottom:1px solid #ccc;" width="10%">Price</th>
                                        <th align="start" style="border-bottom:1px solid #ccc;" width="10%">Quantity
                                        </th>
                                        <th align="start" style="border-bottom:1px solid #ccc;" width="15%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $totalAmount = 0;

                                    // Check if session data exists
                                    if (!empty($sessionProducts)) {
                                        // Loop through each product in the session
                                        foreach ($sessionProducts as $product):
                                            // Calculate the total amount
                                            $totalAmount += $product['price'] * $product['quantity'];
                                    ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc"><?= $i++ ?></td>
                                                <td style="border-bottom: 1px solid #ccc">
                                                    <?= htmlspecialchars($product['name']) ?></td>
                                                <td style="border-bottom: 1px solid #ccc">
                                                    <?= number_format($product['price'], 0) ?></td>
                                                <td style="border-bottom: 1px solid #ccc"><?= $product['quantity'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc">
                                                    <?= number_format($product['price'] * $product['quantity'], 0) ?>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    } else {
                                        echo '<tr><td colspan="5" align="center">No products in the cart.</td></tr>';
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="4" align="end" style="font-weight:bold;">Total: </td>
                                        <td colspan="1" style="font-weight:bold;"><?= number_format($totalAmount, 0) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">Payment Mode: <?= htmlspecialchars($paymentMode) ?>
                                            <?= $_SESSION['loggedInUser']['Phone'] ?>
                                            <?= replaceVowels($_SESSION['loggedInUser']['FName']) ?>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button tpye="button" class="btn btn-danger px-5" id="saveOrder">CONFIRM</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>