<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Delete Customer Account</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Customer to Delete
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CustomerID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
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
                        }
                        ?>
                        <tr>
                            <td>1</td>
                            <td><?= $customer['CustomerID'] ?></td>
                            <td><?= $customer['FName'] ?></td>
                            <td><?= $customer['LName'] ?></td>
                            <td><?= $customer['Address'] ?></td>
                            <td><?= $customer['Email'] ?></td>
                            <td><?= $customer['Phone'] ?></td>
                            <td>
                                <a href="" class="btn btn-sm btn-danger">Confirm</a>
                                <a href="customer.php" class="btn btn-sm btn-success">Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>