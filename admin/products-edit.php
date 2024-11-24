<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Edit Product</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Product Details
                <a href="products.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="products-function.php" method="POST" enctype="multipart/form-data">
                <?php
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = validate($_GET['id']);
                    $response = getById('product', 'ProductID', $id);
                    if ($response['status'] === 200) {
                        $product = $response['data'];
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
                    <input type="hidden" name="productID" value="<?= $product['ProductID'] ?>" class="form-control">
                    <div class="col-md-12 mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select name="category_id" id="category" class="form-select">
                            <option value="" disabled selected>Select Category</option>
                            <?php
                            echo '<h5>' . $product['CategoryID'] . '</h5>';
                            $categories = getAll('product_category');
                            if ($categories) {
                                if (mysqli_num_rows($categories) > 0) {
                                    foreach ($categories as $item) {
                            ?>
                                        <option value="<?= $item['CategoryID'] ?>" <?= $product['CategoryID'] == $item['CategoryID'] ? 'selected' : '' ?>>
                                            <?= $item['CategoryName'] ?>
                                        </option>';
                            <?php
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
                        <input type="text" value="<?= $product['ProductName'] ?>" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price *</label>
                        <input type="text" value="<?= $product['Price'] ?>" name="price" id="price" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Quantity *</label>
                        <input type="text" value="<?= $product['Quantity'] ?>" name="quantity" id="quantity" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-label">Image *</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <img src="../<?= $product['ProductImage'] ?>" width="150px" height="150px" class="image-fluid ms-3 mt-4" alt="Product Image">
                    </div>

                    <div class="col-md-12 mb-3 text-md-end text-center">
                        <button type="submit" name="updateProduct" class="btn btn-success px-5">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>