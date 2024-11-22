<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Create Customer Account</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Customer Details
                <a href="customer.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="customer-function.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First Name *</label>
                        <input type="text" name="fname" id="fname" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last Name *</label>
                        <input type="text" name="lname" id="lname" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Address *</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                        <div class="form-text">Note: City of Malolos Only</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Contact Number *</label>
                        <div class="input-group">
                            <div class="input-group-text">+63</div>
                            <input type="number" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password *</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <button type="submit" name="saveCustomer" class="btn btn-success px-5">Create Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>