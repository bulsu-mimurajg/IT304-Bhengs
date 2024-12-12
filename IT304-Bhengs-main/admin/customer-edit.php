<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Edit Customer Account</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Customer Details
                <a href="customer.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="customer-function.php" method="POST">
                <?php
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = validate($_GET['id']);

                    $response = getById('customer', 'CustomerID', $id);
                    if ($response['status'] === 200) {
                        $customer = $response['data'];
                    } elseif ($response['status'] === 404) {
                        echo '<h5>' . $response['message'] . '</h5>';
                        return false;
                    } elseif ($response['status'] === 500) {
                        echo '<h5>' . $response['message'] . '</h5>';
                        return false;
                    } else {
                        echo '<h5>Something went wrong. (CUSTOMER-EDIT)</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>No ID received.</h5>';
                    return false;
                }
                ?>
                <div class="row">
                    <input type="hidden" name="customerID" value="<?= $customer['CustomerID'] ?>" class="form-control">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First Name *</label>
                        <input type="text" name="fname" id="fname" value="<?= $customer['FName'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last Name *</label>
                        <input type="text" name="lname" id="lname" value="<?= $customer['LName'] ?>" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Address *</label>
                        <input type="text" name="address" id="address" value="<?= $customer['Address'] ?>" class="form-control">
                        <div class="form-text">Note: City of Malolos Only</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" value="<?= $customer['Email'] ?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Contact Number *</label>
                        <div class="input-group">
                            <div class="input-group-text">+63</div>
                            <input type="number" name="phone" id="phone" value="<?= $customer['Phone'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password *</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <button type="submit" name="updateCustomer" class="btn btn-success px-5">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>