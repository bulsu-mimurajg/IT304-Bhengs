<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Customer Accounts</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">List of Customers
                <a href="customer-create.php" class="btn btn-primary float-end">Add Customer</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer ID</th>
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
                        $customers = getAll('customer');
                        if (mysqli_num_rows($customers) > 0) {
                            $count = 0;
                            foreach ($customers as $customer) :
                                $count++;
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $customer['CustomerID'] ?></td>
                                    <td><?= $customer['FName'] ?></td>
                                    <td><?= $customer['LName'] ?></td>
                                    <td><?= $customer['Address'] ?></td>
                                    <td><?= $customer['Email'] ?></td>
                                    <td><?= $customer['Phone'] ?></td>
                                    <td class="text-nowrap">
                                        <a href="customer-edit.php?id=<?= $customer['CustomerID'] ?>" class="btn btn-sm btn-success">Edit</a>
                                        <a href="customer-delete.php?id=<?= $customer['CustomerID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete customer?')">Delete</a>
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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>