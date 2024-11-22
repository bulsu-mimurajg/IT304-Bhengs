<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Create Product</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Product Details
                <a href="products.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="products-function.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select name="category_id" id="category" class="form-select" required>
                            <option value="" disabled selected>Select Category</option>
                            <?php
                            $categories = getAll('product_category');
                            if ($categories) {
                                if (mysqli_num_rows($categories) > 0) {
                                    foreach ($categories as $item) {
                                        echo '<option value="' . $item['CategoryID'] . '">' . $item['CategoryName'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No category found.</option>';
                                }
                            } else {
                                echo 'option value="">Something went wrong.</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price *</label>
                        <input type="text" name="price" id="price" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantity *</label>
                        <input type="text" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-label">Image *</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <button type="submit" name="saveProduct" class="btn btn-success float-end px-5">Create Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>