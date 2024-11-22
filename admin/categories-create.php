<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Create Product Category</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">Category Details
                <a href="categories.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="categories-function.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" name="saveCategory" class="btn btn-success float-end px-5">Create Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>