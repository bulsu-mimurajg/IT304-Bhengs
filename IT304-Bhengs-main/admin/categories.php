<?php include('includes/header.php') ?>

<div class="container-fluid px-4">
    <h1 class="mt-3">Product Category</h1>
    <div class="card mt-5 shadow">
        <div class="card-header">
            <h4 class="mb-0">List of Categories
                <a href="categories-create.php" class="btn btn-primary float-end">Add Category</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $categories = getAll('product_category');
                        if (mysqli_num_rows($categories) > 0) {
                            $count = 0;
                            foreach ($categories as $item) :
                                $count++;
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $item['CategoryID'] ?></td>
                                    <td><?= $item['CategoryName'] ?></td>
                                    <td><?= $item['CategoryDescription'] ?></td>
                                    <td class="text-nowrap">
                                        <a href="categories-edit.php?id=<?= $item['CategoryID'] ?>" class="btn btn-sm btn-success">Edit</a>
                                        <a href="categories-delete.php?id=<?= $item['CategoryID'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete category?')">Delete</a>
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