<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Edit Product Category</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Category Details
                <a href="categories.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="categories-function.php" method="POST">
                <?php
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = validate($_GET['id']);

                    $response = getById('product_category', 'CategoryID', $id);
                    if ($response['status'] === 200) {
                        $categories = $response['data'];
                    } elseif ($response['status'] === 404) {
                        echo '<h5>' . $response['message'] . '</h5>';
                        return false;
                    } elseif ($response['status'] === 500) {
                        echo '<h5>' . $response['message'] . '</h5>';
                        return false;
                    } else {
                        echo '<h5>Something went wrong. (CATEGORIES-EDIT)</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>No ID received.</h5>';
                    return false;
                }
                ?>
                <div class="row">
                    <input type="hidden" name="categoryID" value="<?= $categories['CategoryID'] ?>" class="form-control">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" value="<?= $categories['CategoryName'] ?>" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="2"><?= $categories['CategoryDescription'] ?></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" name="updateCategory" class="btn btn-success float-end px-5">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>